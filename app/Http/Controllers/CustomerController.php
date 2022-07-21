<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Models\Invoice;
use App\Models\InvoiceDetail;
use App\Models\Payment;
use App\Models\PaymentType;
use App\Models\Product;
use App\Models\ProductType;
use Barryvdh\DomPDF\Facade\Pdf;
use Carbon\Carbon;
use Exception;
use GuzzleHttp\Handler\Proxy;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Session;

class CustomerController extends Controller
{
    public function index()
    {
        $active='Trang chủ';
        $data=Product::with('imageDetail')->latest()->take(5)->get();
        //Category::whereHas('posts', function ($q) { $q->published(); })->get();
        //Category::has('postsPublished')
        $newProduct=Product::with('imageDetail')->whereHas('productType',function($q){return $q->phone();})->latest()->take(5)->get();
        $phone=Product::with('imageDetail')->whereHas('productType',function($q){return $q->phone();})->orderByDesc('amount')->take(5)->get();
        $tablet=Product::with('imageDetail')->whereHas('productType',function($q){return $q->tablet();})->orderByDesc('amount')->take(5)->get();
        $laptop=Product::with('imageDetail')->whereHas('productType',function($q){return $q->laptop();})->orderByDesc('amount')->take(5)->get();
        return view("customer.src.index",compact('active','data','newProduct','phone','tablet','laptop'));
    }
    public function phone() {
        $active='Điện Thoại';
        $phone=Product::with('imageDetail')->whereHas('productType',function($q){return $q->phone();})->orderByDesc('amount')->get();
        return view("customer.src.phone",compact('active','phone'));
    }
    public function tablet() {
        $active='Tablet';
        $tablet=Product::with('imageDetail')->whereHas('productType',function($q){return $q->tablet();})->orderByDesc('amount')->get();
        return view("customer.src.tablet",compact('active','tablet'));
    }
    public function laptop(){
        $active='Laptop';
        $laptop=Product::with('imageDetail')->whereHas('productType',function($q){return $q->laptop();})->orderByDesc('amount')->get();
        return view("customer.src.laptop",compact('active','laptop'));
    }
    public function cart()
    {
        return view('customer.src.cart');
    }
    public function shop()
    {
        return view('customer.src.shop');
    }
    public function checkout()
    {
        return view('customer.src.checkout');
    }
    public function productDetail($id)
    {
        $active='Điện Thoại';
        $product=Product::with('imageDetail')->where('id',$id)->first();
        $data=Product::with('imageDetail','allTypeDetail.allType')->where('id',$id)->first();
        $product1=Product::with('imageDetail')->where('id',$id)->first();
        $product2=Product::with('imageDetail')->where('id',$id)->first();
        $phone=Product::with('imageDetail')->whereHas('productType',function($q){return $q->phone();})->orderByDesc('amount')->take(5)->get();
        $tablet=Product::with('imageDetail')->whereHas('productType',function($q){return $q->tablet();})->orderByDesc('amount')->take(5)->get();
        return view('customer.src.product_details',compact('data','id','active','product','product1','product2','phone','tablet'));
    }
    public function contact()
    {
        $active='Liên hệ';
        return view('customer.src.contact',compact('active'));
    }
    public function payment(Request $request){
        $active='';
        $info=$request->all();
        return view('customer.src.payment',compact('info','active'));
    }
    public function postPayment(Request $request){
        //dd($request);
       DB::beginTransaction();
       try{
        $input=$request->all();
        //tinh tong tien
        $total=0;
        $i=0;
        $namephone='namephone';
        $amount='amount';
        $sumTotal='sumtotal';
        do{
            $namephone.=$i;
            $amount.=$i;
            $sumTotal.=$i;

            $total+=$input[$sumTotal];

            $namephone='namephone';
            $amount='amount';
            $sumTotal='sumtotal';
            $i++;
        }while(!empty($input[$sumTotal.$i] ));
        //user =1, khach tao
        $insertInvoice=Invoice::insertGetId([
            'user_id' =>'1',
            'name_customer' => $request->name_customer,
            'email_customer' => $request->email_customer,
            'phone' => $request->phone,
            'address_customer' => $request->address_customer,
            'message' => $request->message,
            'total' => $total,
            'created_at' => Carbon::now(),
        ]);
        $searchPaymentType=PaymentType::where('card_type',$request->card_type)->first();
        $insertPayment=Payment::insert([
            'invoice_id' =>$insertInvoice,
            'payment_type'=>$searchPaymentType->id,
            'total_money'=>$total,
            'created_at' => Carbon::now(),
        ]);
        //them chi tiet hd
        $i=0;
        do{
            $namephone.=$i;
            $amount.=$i;
            $sumTotal.=$i;
            $product=Product::where('name_product',$input[$namephone])->first();
            $insertInvoiceDetails = InvoiceDetail::insert([
                'invoice_id'=>$insertInvoice,
                'product_id'=>$product->id,
                'amount' =>$input[$amount],
                'price'=>$product->price,
                'created_at'=>Carbon::now(),
            ]);

            $namephone='namephone';
            $amount='amount';
            $sumTotal='sumtotal';
            $i++;
        }while(!empty($input[$sumTotal.$i])||!empty($input[$namephone.$i]));
        Session()->flash('success', 'Thêm hóa đơn thành công');
        return redirect()->route('indexCustomer');
        DB::commit();
       }
       catch(Exception $e){
        DB::rollBack();
        throw $e;
       }
    }
    public function postCommentCustomer(Request $request,$id){
        try{
            $data=Comment::insert([
                'product_id' =>$id,
                'name_customer' => $request->name_customer,
                'email_customer' => $request->email_customer,
                'phone_customer' => $request->phone_customer,
                'message_customer' => $request->message_customer,
                'created_at'=>Carbon::now('Asia/Ho_Chi_Minh'),
            ]);
            Session()->flash('success', 'Gửi bình luận thành công');
            return redirect()->back();
        }catch(Exception $e){
            DB::rollBack();
            Session()->flash('success', 'Gửi bình luận thất bại');
            return redirect()->back();
        }
    }
}
