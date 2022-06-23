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
    Route::get('/', [CustomerController::class, 'index'])->name('index');
    Route::get('cart', [CustomerController::class, 'cart'])->name('cart');
    Route::get('checkout', [CustomerController::class, 'checkout'])->name('checkout');
    Route::get('shop', [CustomerController::class, 'shop'])->name('shop');
    Route::get('single_product', [CustomerController::class, 'single_product'])->name('single_product');
    Route::get('contact', [CustomerController::class, 'contact'])->name('contact');
});

Route::group(['prefix' => '/login'], function () {
    Route::get('/', [LoginController::class, 'login'])->name('login')->middleware('CheckUser');
    Route::post('/', [LoginController::class, 'postLogin'])->name('postLogin');
    Route::get('/logout', [LoginController::class, 'logout'])->name('logout');
});

Route::group(['prefix' => '/admin'], function () {
    Route::get('/', function () {
        return redirect()->route('login');
    });
    Route::get('/index', [AdminController::class, 'index'])->name('index');
    Route::get('/product', [AdminController::class, 'product'])->name('product');
    Route::get('/invoice', [AdminController::class, 'invoice'])->name('invoice');
    Route::get('/staff', [AdminController::class, 'staff'])->name('staff');
    Route::get('/report', [AdminController::class, 'report'])->name('report');
    Route::get('/provided', [AdminController::class, 'provided'])->name('provided');
    Route::get('/invoice_provided', [AdminController::class, 'invoiceProvided'])->name('invoiceProvided');

    Route::get('/add_provided', [AdminController::class, 'addProvided'])->name('addProvided');
    Route::post('/add_provided', [AdminController::class, 'postAddProvided'])->name('postAddProvided');
    Route::get('/add_invoice', [AdminController::class, 'addInvoice'])->name('addInvoice');
    Route::post('/add_invoice', [AdminController::class, 'postAddInvoice'])->name('postAddInvoice');
    Route::get('/add_product', [AdminController::class, 'addProduct'])->name('addProduct');
    Route::post('/add_product', [AdminController::class, 'postAddProduct'])->name('postAddProduct');
    Route::get('/add_staff', [AdminController::class, 'addStaff'])->name('addStaff');
    Route::post('/add_staff', [AdminController::class, 'postAddStaff'])->name('postAddStaff');
    Route::get('/add_invoice_provided', [AdminController::class, 'addInvoiceProvided'])->name('addInvoiceProvided');
    Route::post('/add_invoice_provided', [AdminController::class, 'postAddInvoiceProvided'])->name('postAddInvoiceProvided');
    Route::get('/add_invoice_provided_not_yet', [AdminController::class, 'addInvoiceProvidedNotYet'])->name('addInvoiceProvidedNotYet');
    Route::post('/add_invoice_provided_not_yet', [AdminController::class, 'postAddInvoiceProvidedNotYet'])->name('postAddInvoiceProvidedNotYet');


    Route::get('/edit_staff/{id}', [AdminController::class, 'editStaff'])->name('editStaff');
    Route::post('/edit_staff/{id}', [AdminController::class, 'postEditStaff'])->name('postEditStaff');
    Route::get('/edit_provided/{id}', [AdminController::class, 'editProvided'])->name('editProvided');
    Route::post('/edit_provided/{id}', [AdminController::class, 'postEditProvided'])->name('postEditProvided');
    Route::get('/edit_invoice/{id}', [AdminController::class, 'editInvoice'])->name('editInvoice');
    Route::post('/edit_invoice/{id}', [AdminController::class, 'postEditInvoice'])->name('postEditInvoice');
    Route::get('/edit_product/{id}', [AdminController::class, 'editProduct'])->name('editProduct');
    Route::post('/edit_product/{id}', [AdminController::class, 'postEditProduct'])->name('postEditProduct');
    Route::get('/edit_invoice_provided/{id}', [AdminController::class, 'editInvoiceProvided'])->name('editInvoiceProvided');
    Route::post('/edit_invoice_provided/{id}', [AdminController::class, 'postEditInvoiceProvided'])->name('postEditInvoiceProvided');

    Route::get('/delete_invoice/{id}', [AdminController::class, 'deleteInvoice'])->name('deleteInvoice');
    Route::get('/delete_product/{id}', [AdminController::class, 'deleteProduct'])->name('deleteProduct');
    Route::get('/delete_provided/{id}', [AdminController::class, 'deleteProvided'])->name('deleteProvided');
    Route::get('/delete_staff/{id}', [AdminController::class, 'deleteStaff'])->name('deleteStaff');
    Route::get('/delete_invoice_provided/{id}', [AdminController::class, 'deleteInvoiceProvided'])->name('deleteInvoiceProvided');

    //export excel
    Route::get('/exportProvided', [AdminController::class, 'exportProvided'])->name('exportProvided');
    Route::get('/exportInvoice', [AdminController::class, 'exportInvoice'])->name('exportInvoice');
    Route::get('/exportProduct', [AdminController::class, 'exportProduct'])->name('exportProduct');
    Route::get('/exportStaff', [AdminController::class, 'exportStaff'])->name('exportStaff');

    //import excel
    Route::get('/importProvided', [AdminController::class, 'importProvided'])->name('importProvided');
    Route::post('/importProvided', [AdminController::class, 'postImportProvided'])->name('postImportProvided');

});
