<?php

namespace App\Http\Controllers;

use App\Exports\exportExcelInvoice;
use App\Exports\exportExcelProduct;
use Illuminate\Http\Request;
use App\Models\Invoice;
use Illuminate\Support\Facades\Hash;
use App\Models\Product;
use App\Models\ProductType;
use App\Models\Provided;
use App\Models\UserDB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use Session;
use Illuminate\Support\Str;
use App\Exports\exportExcelProvided;
use App\Exports\exportExcelUser;
use App\Imports\ProvidedImport;
use App\Models\Account;
use App\Models\InvoiceProvided;
use App\Models\InvoiceProvidedDetail;
use GuzzleHttp\Handler\Proxy;
use Maatwebsite\Excel\Facades\Excel;
use Prophecy\Call\Call;

class AdminController extends Controller
{

    public function __construct()
    {
        $this->middleware('CheckAuth');
    }
    //TRANG CHỦ ADMIN
    public function index()
    {
        $product = Product::count();
        $countInvoiceOnMonth = DB::table('invoices')->where([
            ['status', '=', 'Đã xử lí'],
            ['created_at', '=', Carbon::now()->month],
        ])->count();
        $outOfProduct = DB::table('products')->where([
            ['status', '=', 'Đang hoạt động'],
            ['amount', '<', '10'],
        ])->count();
        $invoice = Invoice::orderByDesc('status')->get()->take(4);
        return view('admin.src.index', compact('product', 'countInvoiceOnMonth', 'outOfProduct', 'invoice'));
    }

    //TRANG SẢN PHẨM ADMIN
    // Đang hoạt động/Hết hàng/Đã hủy
    public function product()
    {
        $product = Product::all()->sortByDesc('status');
        // $provided=Provided::all()->where('status','=',"Đang hoạt động");
        //$productType=ProductType::all()->where('status','=',"Đang hoạt động");
        return view('admin.src.product', compact('product'));
    }
    //add sản phẩm
    public function addProduct()
    {
        return view('admin.src.add_product');
    }
    public function postAddProduct(Request $request)
    {
        $describe = ' ';
        if (!empty($request->describe)) {
            $describe = $request->describe;
        }
        //them image sau
        $db = DB::table('products')->insert([
            'account_id' => Auth::id(),
            'name' => $request->name,
            'product_type_id' => $request->product_type_id,
            'provided_id' => $request->provided_id,
            'amount' => $request->amount,
            'price' => $request->price,
            'tax' => $request->tax,
            'images' => '',
            'describe' => $describe,
            'product_code' => Str::random(10),
        ]);
        Session()->flash('success', 'Thêm sản phẩm thành công');
        return redirect()->route('product');
    }
    //edit sản phẩm
    public function editProduct($id)
    {
        $product = Product::find($id);
        $productType = ProductType::all();
        return view('admin.src.edit_product', compact('product', 'productType'));
    }
    public function postEditProduct(Request $request, $id)
    {
        //số lượng = sp+ số lượng
        $name = $request->name;
        //$image=$request->image;
        $amount = $request->amount + $request->addamount;
        $price = $request->price;
        $tax = $request->tax;
        $sold = $request->sold;
        $productType = $request->product_type;
        $status = $request->status;
        $db = DB::table('products')->where('id', $id)->update([
            'name' => $name,
            'amount' => $amount,
            'price' => $price,
            'tax' => $tax,
            'sold' => $sold,
            'product_type_id' => $productType,
            'status' => $status,
            'updated_at' => Carbon::now(),
        ]);
        Session()->flash('success', 'Thay đổi dữ liệu sản phẩm thành công');
        return redirect()->route('product');
    }
    public function deleteProduct($id)
    {
        $delete = DB::table('products')->where('id', '=', $id)->update(['status' => 'Dừng hoạt động']);
        Session()->flash('success', 'Xóa sản phẩm thành công');
        return redirect()->route('product');
    }
    //TRANG NHẬP SẢN PHẨM
    public function invoiceProduct()
    {
        $invoiceProduct = DB::table('invoice_provided_details')
            ->join('products', 'invoice_provided_details.product_id', '=', 'products.id')
            ->get();
        //dd($invoiceProduct);
        return view('admin.src.invoice_product', compact('invoiceProduct'));
    }
    //TRANG HÓA ĐƠN ADMIN
    public function invoice()
    {
        $data = Invoice::all()->sortByDesc('status')->sortByDesc('created_at');
        return view('admin.src.invoice', compact('data'));
    }
    //add hóa đơn
    public function addInvoice()
    {
        $product = Product::all()->where('status', '=', "Đang hoạt động");
        return view('admin.src.add_invoice', compact('product'));
    }
    public function postAddInvoice(Request $request)
    {
        $input = $request->all();
        if (empty($request->note)) {
            $note = '';
        } else {
            $note = $request->note;
        }
        $data = DB::table('invoices')->insertGetId([
            'account_id' => Auth::id(),
            'name_customer' => $request->name,
            'email_customer' => $request->email,
            'phone' => $request->phone,
            'address_customer' => $request->address,
            'total' => $request->total,
            'message' => $request->note,
            'status' => $request->status,
            'created_at' => Carbon::now(),
        ]);
        $productDetailds = !empty($input['nameProduct']) ? $input['nameProduct'] : [];
        if ($data) {
            foreach ($productDetailds as $productDetaild) {
                $productId = (int)$productDetaild;
                $product = Product::find($productId);
                $addInvoiceDetail = DB::table('invoice_details')->insert([
                    'invoice_id' => $data,
                    'product_id' => $product->id,
                    'amount' => $product->amount,
                    'price' => $product->amount,
                    'discount' => '0',
                    'promotion' => '0',
                ]);
            }

            if ($addInvoiceDetail) {
                Session()->flash('success', 'Thêm hóa đơn thành công');
                return redirect()->route('invoice');
            } else {
                Session()->flash('success', 'Thêm chi tiết hóa đơn thất bại');
                return redirect()->route('invoice');
            }
        } else {
            Session()->flash('success', 'Thêm hóa đơn thất bại');
            return redirect()->route('invoice');
        }
    }
    //edit hóa đơn
    public function editInvoice($id)
    {
        $invoice = Invoice::find($id);
        return view('admin.src.edit_invoice', compact('invoice'));
    }
    public function postEditInvoice(Request $request, $id)
    {
        $name_customer = '';
        $email_customer = '';
        $phone = '';
        $address_customer = '';
        $message = '';
        if (!empty($request->name_customer)) {
            $name_customer = $request->name_customer;
        }
        if (!empty($request->email_customer)) {
            $email_customer = $request->email_customer;
        }
        if (!empty($request->phone)) {
            $phone = $request->phone;
        }
        if (!empty($request->address_customer)) {
            $address_customer = $request->address_customer;
        }
        if (!empty($request->message)) {
            $message = $request->message;
        }
        if (isset($request->status)) {
            $status = $request->status;
        }
        $update = DB::table('invoices')->where('id', $id)->update([
            'name_customer' => $name_customer,
            'email_customer' => $email_customer,
            'phone' => $phone,
            'address_customer' => $address_customer,
            'message' => $message,
            'status' => $status,
            'updated_at' => Carbon::now(),
        ]);
        Session()->flash('success', 'Thay đổi dữ liệu đơn hàng thành công');
        return redirect()->route('invoice');
    }
    public function deleteInvoice($id)
    {
        $delete = DB::table('invoices')->where('id', '=', $id)->update(['status' => 'Đã hủy']);
        Session()->flash('success', 'Xóa hóa đơn thành công');
        return redirect()->route('invoice');
    }
    //TRANG NHẬP HÓA ĐƠN
    public function invoiceProvided()
    {
        $invoiceProvides = DB::table('invoice_provides')->join('invoice_provided_details', 'invoice_provides.id', '=', 'invoice_provided_details.invoice_provided_id')->get();
        // dd($invoiceProvides);
        return view('admin.src.invoice_provided', compact('invoiceProvides'));
    }
    public function addInvoiceProvided()
    {
        $provided = Provided::all();
        $product = Product::all();
        return view('admin.src.add_invoice_provided', compact('provided', 'product'));
    }
    public function postAddInvoiceProvided(Request $request)
    {
        $total = $request->amount * $request->import_price;
        $describe = 'Không';
        if (!empty($request->describe)) {
            $describe = $request->describe;
        }
        if ($request->hasFile('image')) {
            $request->validate([
                'image' => 'mimes:jpeg,bmp,png' // Only allow .jpg, .bmp and .png file types.
            ]);
            $request->image->store('images', 'public');
            $invoiceProvided = DB::table('invoice_provides')->insertGetId([
                'provided_id' => $request->id_provided,
                'account_id' => Auth::id(),
                'total' => $total,
                'status' => $request->status,
                'created_at' => Carbon::now(),
            ]);
            if (!empty($invoiceProvided)) {
                $invoiceProvidedDetail = DB::table('invoice_provided_details')->insertGetId([
                    'invoice_provided_id' => $invoiceProvided,
                    'product_id' => $request->product_id,
                    'image_url' => $request->image->hashName(),
                    'amount' => $request->amount,
                    'import_price' => $request->import_price,
                    'time_warranty' => $request->time_warranty,
                    'tax' => $request->tax,
                    'describe' => $describe,
                    'created_at' => Carbon::now(),
                ]);
                //tim chi tiet nhap
                $temp = InvoiceProvidedDetail::find($invoiceProvidedDetail);
                //tim san pham
                $searchAmountProduct = Product::where('id', '=', $temp->product_id)->get();
                //tong
                dd($searchAmountProduct);
                $sumAmountProduct = $searchAmountProduct->amount + $temp->amount;
                $sumPrice = $temp->price + $temp->price * 0.1;
                if (!empty($invoiceProvidedDetail)) {
                    // update table product
                    $product = Product::where('id', '=', $temp->product_id)->update([
                        'images' => $temp->image_url,
                        'amount' => $sumAmountProduct,
                        'price' => $sumPrice,
                        'time_warranty' => $temp->time_warranty,
                        'tax' => $temp->tax,
                        'describe' => $temp->describe,
                        'updated_at' => Carbon::now(),
                    ]);
                    if (!empty($product)) {
                        Session()->flash('success', 'Thêm hóa đơn nhà cung cấp thành công');
                        return redirect()->route('invoiceProvided');
                    }
                }
            }
            Session()->flash('success', 'Thêm hóa đơn nhà cung cấp thất bại');
            return redirect()->route('invoiceProvided');
        }
        Session()->flash('success', 'Kiểm tra lại hình ảnh');
        return redirect()->route('invoiceProvided');
    }
    public function addInvoiceProvidedNotYet()
    {
        $provided = Provided::all();
        $productType = ProductType::all();
        return view('admin.src.add_invoice_provided_not_yet', compact('provided', 'productType'));
    }
    public function postAddInvoiceProvidedNotYet(Request $request)
    {
        $total = $request->amount * $request->import_price;
        // $describe='Không';
        // if(!empty($request->describe)){
        //     $describe=$request->describe;
        // }
        if ($request->hasFile('image')) {
            $request->validate([
                'image' => 'mimes:jpeg,bmp,png' // Only allow .jpg, .bmp and .png file types.
            ]);
            $request->image->store('images', 'public');
            $invoiceProvided = InvoiceProvided::insertGetId([
                'provided_id' => $request->id_provided,
                'account_id' => Auth::id(),
                'total' => $total,
                'status' => $request->status,
                'created_at' => Carbon::now(),
            ]);
            if (!empty($invoiceProvided)) {
                if (empty($request->image)) {
                    $invoiceProvidedDetails = InvoiceProvidedDetail::insertGetId([
                        'invoice_provided_id' => $invoiceProvided,
                        'product_type_id' => $request->id_product_type,
                        'name' => $request->name,
                        'trademark' => $request->trademark,
                        'product_code' => $request->product_code,
                        'amount' => $request->amount,
                        'import_price' => $request->import_price,
                        'time_warranty' => $request->time_warranty,
                        'tax' => $request->tax,
                        'created_at' => Carbon::now(),
                    ]);
                } else {
                    $invoiceProvidedDetails = InvoiceProvidedDetail::insertGetId([
                        'invoice_provided_id' => $invoiceProvided,
                        'product_type_id' => $request->id_product_type,
                        'image_url' => $request->image->hashName(),
                        'name' => $request->name,
                        'trademark' => $request->trademark,
                        'product_code' => $request->product_code,
                        'amount' => $request->amount,
                        'import_price' => $request->import_price,
                        'time_warranty' => $request->time_warranty,
                        'tax' => $request->tax,
                        'created_at' => Carbon::now(),
                    ]);
                }

                //tim
                $temp = InvoiceProvidedDetail::find($invoiceProvidedDetails);

                $sumPrice = $temp->import_price + $temp->import_price * 0.1;
                if (!empty($invoiceProvidedDetails)) {
                    //them bang sp
                    if (!empty($temp->describe)) {
                        $product = Product::insertGetId([
                            'account_id' => Auth::id(),
                            'product_type_id' => $temp->product_type_id,
                            'name' => $temp->name,
                            'images' => $temp->image_url,
                            'trademark' => $temp->trademark,
                            'product_code' => $temp->product_code,
                            'amount' => $temp->amount,
                            'price' => $sumPrice,
                            'describe' => $temp->describe,
                            'time_warranty' => $temp->time_warranty,
                            'tax' => $temp->tax,
                            'created_at' => Carbon::now(),
                        ]);
                    }
                    //tim id sp=>update id sp trong cthd nhap
                    $codeProduct = Product::find($product);
                    $addProductIdToInvoiceProvidedDetail = InvoiceProvidedDetail::where('product_code', '=', $codeProduct->product_code)->update([
                        'product_id' => $codeProduct->id,
                        'updated_at' => Carbon::now(),
                    ]);
                    if (!empty($product) && !empty($addProductIdToInvoiceProvidedDetail)) {
                        Session()->flash('success', 'Thêm hóa đơn nhà cung cấp thành công');
                    }
                }
            }
            Session()->flash('success', 'Thêm hóa đơn nhà cung cấp thất bại');
        } else {
            Session()->flash('success', 'Kiểm tra lại hình ảnh');
            return redirect()->back();
        }
        return redirect()->route('invoiceProvided');
    }
    public function editInvoiceProvided($id)
    {
    }
    public function postEditInvoiceProvided(Request $request, $id)
    {
    }
    public function deleteInvoiceProvided($id)
    {
    }
    //TRANG QUẢN LÍ NHÂN VIÊN ADMIN
    public function staff()
    {
        $user = UserDB::all()->sortByDesc('status');
        return view('admin.src.staff', compact('user'));
    }
    //add nhân viên
    public function addStaff()
    {
        return view('admin.src.add_staff');
    }
    public function postAddStaff(Request $request)
    {
        $acc = Account::insertGetId([
            'username' => $request->username,
            'password' => Hash::make($request->password),
            'token' => Str::random(64),
            'status' => "Đang hoạt động",
            'created_at' => Carbon::now(),
        ]);
        if($request->hasFile('image_url')){
            $request->validate([
                'image_url' => 'mimes:jpeg,bmp,png' // Only allow .jpg, .bmp and .png file types.
            ]);
            $request->image_url->store('images', 'public');
            $user = UserDB::insert([
                // add_image
                'account_id' => $acc,
                'fullname' => $request->fullname,
                'image_url' => $request->image_url->hashName(),
                'sex' =>$request->sex,
                'birthday' => $request->birthday,
                'citizen_ID' => $request->citizen_ID,
                'address' => $request->address,
                'phone' => $request->phone,
                'email' => $request->email,
                'permission' => $request->permission,
                'created_at' => Carbon::now(),
            ]);
            if (!empty($user) && !empty($acc)) {
                Session()->flash('success', 'Thêm nhân viên thành công');
                return redirect()->route('staff');
            } else {
                Session()->flash('success', 'Thêm nhân viên thất bại');
                return redirect()->route('staff');
            }
        }
        Session()->flash('success', 'Kiểm tra lại hình ảnh');
        return redirect()->route('staff');
    }
    //edit nhân viên
    public function editStaff($id)
    {
        $staff = UserDB::find($id);
        return view('admin.src.edit_staff', compact('staff'));
    }
    public function postEditStaff(Request $request, $id)
    {
        $user = DB::table('users')->where('id', '=', $id)->update([
            'fullname' => $request->fullname,
            //image
            'address' => $request->address,
            'birthday' => $request->birthday,
            'email' => $request->email,
            'phone' => $request->phone,
            'permission' => $request->permission,
            'status' => $request->status,
            'updated_at' => Carbon::now(),
        ]);
        if (!empty($user)) {
            Session()->flash('success', 'Thay đổi thông tin nhân viên thành công');
            return redirect()->route('staff');
        } else {
            Session()->flash('success', 'Thay đổi thông tin nhân viên thất bại');
            return redirect()->route('staff');
        }
    }
    public function deleteStaff($id)
    {
        $staff = DB::table('users')->where('id', '=', $id)->update(['status' => "Dừng hoạt động"]);
        Session()->flash('success', 'Xóa nhân viên thành công');
        return redirect()->route('staff');
    }
    //TRANG LƯƠNG ADMIN
    public function money()
    {
        return view('admin.src.money');
    }
    //add lương
    public function addMoney()
    {
        return view('admin.src.add_money');
    }
    //edit lương
    public function editMoney()
    {
        return view('admin.src.edit_money');
    }

    //TRANG NHÀ CUNG CẤP
    public function provided()
    {
        $provided = Provided::orderByDesc('status')->get();
        return view('admin.src.provided', compact('provided'));
    }
    public function addProvided()
    {
        return view('admin.src.add_provided');
    }
    public function postAddProvided(Request $request)
    {
        $note = '';
        if (!empty($request->notes)) {
            $note = $request->notes;
        }
        $db = DB::table('provideds')->insert([
            'name' => $request->name,
            'tax_code' => $request->tax_code,
            'email' => $request->email,
            'phone' => $request->phone,
            'address' => $request->address,
            'notes' => $note,
            'created_at' => Carbon::now(),
        ]);
        Session()->flash('success', 'Thêm nhà cung cấp thành công');
        return redirect()->route('provided');
    }
    public function editProvided($id)
    {
        $provided = Provided::find($id);
        return view('admin.src.edit_provided', compact('provided'));
    }
    public function postEditProvided(Request $request, $id)
    {
        $db = DB::table('provideds')->where('id', $id)->update([
            'tax_code' => $request->tax_code,
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'address' => $request->address,
            'status' => $request->status,
            'notes' => $request->notes,
            'updated_at' => Carbon::now(),
        ]);
        Session()->flash('success', 'Thay đổi dữ liệu nhà cung cấp thành công');
        return redirect()->route('provided');
    }
    public function deleteProvided($id)
    {
        $db = DB::table('provideds')->where('id', '=', $id)->update([
            'status' => ' Dừng hoạt động',
            'updated_at' => Carbon::now(),
        ]);
        Session()->flash('success', 'Xóa dữ liệu thành công');
        return redirect()->route('provided');
    }
    //TRANG BÁO CÁO
    public function report()
    {
        return view('admin.src.report');
    }
    public function exportProvided()
    {
        return Excel::download(new exportExcelProvided, 'provided.xlsx');
    }
    public function exportInvoice()
    {
        return Excel::download(new exportExcelInvoice, 'invoice.xlsx');
    }
    public function exportProduct()
    {
        return Excel::download(new exportExcelProduct, 'product.xlsx');
    }
    public function exportStaff()
    {
        return Excel::download(new exportExcelUser, 'user.xlsx');
    }
    public function importProvided()
    {
        return view('admin.src.import.importProvided');
    }
    public function postImportProvided(Request $request)
    {
        Excel::import(new ProvidedImport, request()->file('file'));
        return redirect()->route('provided');
    }
}
