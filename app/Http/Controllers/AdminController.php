<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Invoice;
use App\Models\InvoiceDetail;
use App\Modelss\Comment;
use App\Models\Payment;
use Illuminate\Support\Facades\Hash;
use App\Models\PaymentType;
use App\Models\Product;
use App\Models\ProductType;
use App\Models\Provided;
use App\Models\UserDB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use Session;
use Illuminate\Support\Str;
use Prophecy\Call\Call;

use App\Exports\exportExcelProvided;
use Maatwebsite\Excel\Facades\Excel;

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
    public function importProduct()
    {
        return view('admin.src.import_product');
    }
    //add nhập sản phẩm
    public function addImportProduct()
    {
        return view('admin.src.add_import_product');
    }
    //TRANG HÓA ĐƠN ADMIN
    public function invoice()
    {
        // $data=DB::table('invoices')
        //     ->join('users','users.id','=','invoices.account_id')
        //     ->join('invoice_details','invoices.id','=','invoice_details.invoice_id')
        //     ->join('products','products.id','=','invoice_details.product_id')
        //     ->orderBy('invoices.status','DESC')
        //     ->orderBy('invoices.created_at','DESC')
        //     ->get();
        // dd($data);
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
            'message' => $request->note,
            'status' => $request->status,
            'created_at' => Carbon::now(),
        ]);
        if ($data) {
            $addInvoiceDetail = DB::table('invoice_details')->insert([
                'invoice_id' => $data,
                'product_id' => $request->nameProduct,
                'amount' => $request->amount,
                'discount' => '0',
            ]);
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
    public function importInvoice()
    {
        return view('admin.src.import_invoice');
    }
    //add nhập hóa đơn
    public function addImportInvoice()
    {
        return view('admin.src.add_import_invoice');
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
        $acc = DB::table('accounts')->insertGetId([
            'username' => $request->username,
            'password' => Hash::make($request->password),
            'token' => Str::random(64),
            'status' => "Đang hoạt động",
            'created_at' => Carbon::now(),
        ]);
        $user = DB::table('users')->insert([
            // add_image
            'account_id' => $acc,
            'fullname' => $request->fullname,
            'image_url' => '',
            'birthday' => $request->birthday,
            'address' => $request->address,
            'phone' => $request->phone,
            'email' => $request->email,
            'permission' => $request->permission,
            'status' => "Đang hoạt động",
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
    public function exportProvided(){
        return Excel::download(new exportExcelProvided, 'provided.xlsx');
    }
    public function addProvided()
    {
        return view('admin.src.add_provided');
    }
    public function postAddProvided(Request $request)
    {
        $db = DB::table('provideds')->insert([
            'name' => $request->name,
            'tax_code' => $request->tax_code,
            'email' => $request->email,
            'phone' => $request->phone,
            'address' => $request->address,
            'notes' => $request->notes,
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

}
