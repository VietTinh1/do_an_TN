<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use App\Models\UserDB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Validator;
use Session;
use Illuminate\Support\Facades\Hash;
class LoginController extends Controller
{
    public function login(){
        return view('admin.auth.login');
    }
    public function postLogin(Request $request){

        $login=[
            'username'=>$request->username,
            'password'=>$request->password,
        ];
        if(Auth::attempt($login)){
            return redirect()->route('index');
        }
        else{
           Session()->flash('success', 'Login failed');
            return redirect()->back();
        }
    }
    public function logout(){
        Auth::logout();
        Session()->flash('success','Đăng xuất thành công');
        return redirect()->route('login');
    }
    public function edit(){

    }
    public function register(){

    }
}
