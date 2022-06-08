<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Account;
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
class AdminController extends Controller
{

    public function __construct()
    {
        $this->middleware('CheckAuth');
    }
    public function testStatusInt($index){
        switch($index){
            case 0: return "Đã hủy";
            case 1: return "Chờ xử lí";
            case 2: return "Đang xử lí";
            case 3: return "Đã xử lí";}
    }
    public function testStatusString($index){
        switch($index){
            case "Đã hủy": return "0";
            case "Chờ xử lí": return "1";
            case "Đang xử lí": return "2";
            case "Đã xử lí": return "3";
        }
    }
    //TRANG CHỦ ADMIN
    public function index()
    {
        return view('admin.src.index');
    }

    //TRANG SẢN PHẨM ADMIN
    public function product()
    {
        return view('admin.src.product');
    }
    //add sản phẩm
    public function addProduct()
    {
        return view('admin.src.add_product');
    }
    //edit sản phẩm
    public function editProduct()
    {
        return view('admin.src.edit_product');
    }

    //TRANG HÓA ĐƠN ADMIN
    public function invoice()
    {
        $data = DB::table('invoices')->where('status', '=', 1)->orderByDesc('created_at')->get();
        return view('admin.src.invoice', compact('data'));
    }
    //add hóa đơn
    public function addInvoice()
    {
        $product = Product::all()->where('status', '=', 1);
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
        return view('admin.src.edit_invoice',compact('invoice'));
    }
    public function postEditInvoice(Request $request,$id){
        $status ='';
        $name_customer ='';
        $email_customer ='';
        $phone ='';
        $address_customer ='';
        $created_at ='';
        if(!Empty($request->name_customer)){
            $name_customer = $request->name_customer;
        }
        if(!Empty($request->email_customer)){
            $email_customer = $request->email_customer;
        }
        if(!Empty($request->phone)){
            $phone = $request->phone;
        }
        if(!Empty($request->address_customer)){
            $address_customer = $request->address_customer;
        }
        if(!Empty($request->created_at)){
            $created_at = $request->created_at;
        }
        if(isset($request->status)){
            $status =$request->status;
        }
        dd($status);
    }
    public function deleteInvoice($id){
        $delete =DB::table('invoices')->where('id','=',$id)->update(['status' =>'0']);
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
        return view('admin.src.provided');
    }
    //trang add nhà cung cấp
    public function addProvided()
    {
        return view('admin.src.add_provided');
    }
    //edit nhà cung cấp
    public function editProvided()
    {
        return view('admin.src.edit_provided');
    }

    //TRANG BÁO CÁO
    public function report()
    {
        return view('admin.src.report');
    }

}
