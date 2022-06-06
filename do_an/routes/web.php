<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\CustomerController;
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
});

Route::group(['prefix' => 'admin'], function () {
    Route::get('/login', [AdminController::class, 'getLogin']);
    Route::get('/index', [AdminController::class, 'index'])->name('index');                   
    Route::get('/product', [AdminController::class, 'product'])->name('product');
    Route::get('/invoice', [AdminController::class, 'invoice'])->name('invoice');
    Route::get('/staff', [AdminController::class, 'staff'])->name('staff');
    Route::get('/money', [AdminController::class, 'money'])->name('money');
    Route::get('/report', [AdminController::class, 'report'])->name('report');
    Route::get('/provided', [AdminController::class, 'provided'])->name('provided');
    Route::get('/add_provided', [AdminController::class, 'add_provided'])->name('add_provided');
    Route::get('/add_invoice', [AdminController::class, 'add_invoice'])->name('add_invoice');
    Route::get('/add_product', [AdminController::class, 'add_product'])->name('add_product');
    Route::get('/add_staff', [AdminController::class, 'add_staff'])->name('add_staff');
    Route::get('/add_money', [AdminController::class, 'add_money'])->name('add_money');
});
