<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\LoginController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::group(['prefix' => '/'], function () {
    Route::get('/', [CustomerController::class, 'index'])->name('');
    Route::get('cart', [CustomerController::class, 'cart'])->name('cart');
    Route::get('checkout', [CustomerController::class, 'checkout'])->name('checkout');
    Route::get('shop', [CustomerController::class, 'shop'])->name('shop');
    Route::get('single_product', [CustomerController::class, 'single_product'])->name('single_product');
    Route::get('contact', [CustomerController::class, 'contact'])->name('contact');
});

Route::group(['prefix' => '/admin'], function () {
    Route::get('/login', [LoginController::class, 'login'])->name('login')->middleware('CheckUser');;
    Route::post('/login', [LoginController::class, 'postLogin'])->name('postLogin');
    Route::get('/index', [AdminController::class, 'index'])->name('index');
    Route::get('/product', [AdminController::class, 'product'])->name('product');
    Route::get('/invoice', [AdminController::class, 'invoice'])->name('invoice');
    Route::get('/staff', [AdminController::class, 'staff'])->name('staff');
    Route::get('/money', [AdminController::class, 'money'])->name('money');
    Route::get('/report', [AdminController::class, 'report'])->name('report');
    Route::get('/provided', [AdminController::class, 'provided'])->name('provided');

    Route::get('/add_provided', [AdminController::class, 'addProvided'])->name('addProvided');
    Route::get('/add_invoice', [AdminController::class, 'addInvoice'])->name('addInvoice');
    Route::post('/add_invoice', [AdminController::class, 'postAddInvoice'])->name('postAddInvoice');
    Route::get('/add_product', [AdminController::class, 'addProduct'])->name('addProduct');
    Route::get('/add_staff', [AdminController::class, 'addStaff'])->name('addStaff');
    Route::get('/add_money', [AdminController::class, 'addMoney'])->name('addMoney');

    Route::get('/edit_money', [AdminController::class, 'editMoney'])->name('editMoney');
    Route::get('/edit_staff', [AdminController::class, 'editStaff'])->name('editStaff');
    Route::get('/edit_provided', [AdminController::class, 'editProvided'])->name('editProvided');
    Route::get('/edit_product', [AdminController::class, 'editProduct'])->name('editProduct');

    Route::get('/edit_invoice/{id}', [AdminController::class, 'editInvoice'])->name('editInvoice');
    Route::post('/edit_invoice/{id}', [AdminController::class, 'postEditInvoice'])->name('postEditInvoice');
    Route::get('/delete_invoice/{id}', [AdminController::class, 'deleteInvoice'])->name('deleteInvoice');
});
