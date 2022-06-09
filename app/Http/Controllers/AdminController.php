<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Invoice;
use App\Models\InvoiceDetail;
use App\Models\Comment;
use App\Models\Payment;
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

class AdminController extends Controller
{

    public function __construct()
    {
        $this->middleware('CheckAuth');
    }
    public function testStatusInt($index)
    {
        switch ($index) {
            case 0:
                return "Đã hủy";
            case 1:
                return "Chờ xử lí";
            case 2:
                return "Đang xử lí";
            case 3:
                return "Đã xử lí";
        }
    }
    public function testStatusString($index)
    {
        switch ($index) {
            case "Đã hủy":
                return "0";
            case "Chờ xử lí":
                return "1";
            case "Đang xử lí":
                return "2";
            case "Đã xử lí":
                return "3";
        }
    }
    //TRANG CHỦ ADMIN
    public function index()
    {
        return view('admin.src.index');
    }

    //TRANG SẢN PHẨM ADMIN
    // Đang hoạt động/Hết hàng/Đã hủy
    public function product()
    {
        $product = Product::all();
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
        $amount = $request->amount;
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
    //TRANG HÓA ĐƠN ADMIN
    public function invoice()
    {
        $data = DB::table('invoices')->where('status', '!=', "Đã hủy")->orderByDesc('created_at')->get();
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
                echo "Thêm thất bại";
            }
        } else {
            echo "Thêm thất bại";
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
        $status = $request->status1;
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
        return redirect()->back();
    }
    //TRANG QUẢN LÍ NHÂN VIÊN ADMIN
    public function staff()
    {
        return view('admin.src.staff');
    }
    //add nhân viên
    public function addStaff()
    {
        return view('admin.src.add_staff');
    }
    //edit nhân viên
    public function editStaff()
    {
        return view('admin.src.edit_staff');
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
        $provided = Provided::all();
        return view('admin.src.provided', compact('provided'));
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
            'status' => $request->status,
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
