<?php

namespace App\Http\Controllers;

use App\Models\Product;
use GuzzleHttp\Handler\Proxy;
use Illuminate\Http\Request;

class CustomerController extends Controller
{
    //TRANG CHỦ CUS
    public function index()
    {
        $data=Product::with('imageDetail')->get();
        return view("customer.src.index",compact("data"));
    }

    //TRANG CART CUS
    public function cart()
    {
        return view('customer.src.cart');
    }

    //TRANG SHOP CUS
    public function shop()
    {
        return view('customer.src.shop');
    }

    //TRANG THANH TOÁN CUS
    public function checkout()
    {
        return view('customer.src.checkout');
    }

    //TRANG CHI TIÊT SẢN PHẢM CUS
    public function single_product()
    {
        return view('customer.src.single_product');
    }

    //TRANG LIÊN HỆ
    public function contact()
    {
        return view('customer.src.contact');
    }
}
