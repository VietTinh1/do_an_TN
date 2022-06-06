<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CustomerController extends Controller
{
    //TRANG CHỦ CUS
    public function index()
    {
        return view("customer.src.index");
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
}
