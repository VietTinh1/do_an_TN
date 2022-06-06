<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AdminController extends Controller
{
    //TRANG ĐĂNG NHẬP
    public function getLogin()
    {
        return view("admin.auth.login");
    }

    //TRANG CHỦ ADMIN
    public function  index()
    {
        return view("admin.src.index");
    }

    //TRANG SẢN PHẨM ADMIN
    public function product()
    {
        return view("admin.src.product");
    }
    //add sản phẩm
    public function add_product()
    {
        return view('admin.src.add_product');
    }

    //TRANG HÓA ĐƠN ADMIN
    public function invoice()
    {
        return view("admin.src.invoice");
    }
    //add hóa đơn
    public function add_invoice()
    {
        return view('admin.src.add_invoice');
    }

     //TRANG QUẢN LÍ NHÂN VIÊN ADMIN
    public function staff()
    {
        return view("admin.src.staff");
    }
    //trang add nhân viên 
    public function add_staff()
    {
        return view('admin.src.add_staff');
    }

     //TRANG LƯƠNG ADMIN
    public function money()
    {
        return view("admin.src.money");
    }
    //trang add lương
    public function add_money()
    {
        return view("admin.src.add_money");
    }

    //TRANG NHÀ CUNG CẤP
    public function provided()
    {
        return view('admin.src.provided');
    }
    //trang add nhà cung cấp 
    public function add_provided()
    {
        return view('admin.src.add_provided');
    }

    //TRANG BÁO CÁO
    public function report()
    {
        return view('admin.src.report');
    }
}
