<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\ProductType;
use Barryvdh\DomPDF\Facade\Pdf;
use GuzzleHttp\Handler\Proxy;
use Illuminate\Http\Request;
use Session;

class CustomerController extends Controller
{
    public function index()
    {
        $active='Trang chủ';
        $data=Product::with('imageDetail')->get();
        //Category::whereHas('posts', function ($q) { $q->published(); })->get();
        //Category::has('postsPublished')
        $newProduct=Product::with('imageDetail')->orderByDesc('created_at')->take(5)->get();
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
        return view('customer.src.product_details',compact('active'));
    }
    public function contact()
    {
        $active='Liên hệ';
        return view('customer.src.contact',compact('active'));
    }
    public function demo(Request $request){
        dd($request);
        $value = Session::key('shoppingCart');
        dd($value);
    }
}
