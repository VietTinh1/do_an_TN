<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\LoginController;

Route::group(['prefix' => '/'], function () {
    Route::get('/', [CustomerController::class, 'index'])->name('indexCustomer');
    Route::get('phone', [CustomerController::class, 'phone'])->name('phoneCustomer');
    Route::get('tablet', [CustomerController::class, 'tablet'])->name('tabletCustomer');
    Route::get('laptop', [CustomerController::class, 'laptop'])->name('laptopCustomer');
    Route::get('cart', [CustomerController::class, 'cart'])->name('cartCustomer');
    Route::get('checkout', [CustomerController::class, 'checkout'])->name('checkoutCustomer');
    Route::get('shop', [CustomerController::class, 'shop'])->name('shopCustomer');
    Route::get('product_detail/{id}', [CustomerController::class, 'productDetail'])->name('productDetailCustomer');
    Route::get('contact', [CustomerController::class, 'contact'])->name('contactCustomer');

    Route::get('/payment', [CustomerController::class, 'payment'])->name('paymentCustomer');
    Route::post('/payment', [CustomerController::class, 'postPayment'])->name('postPaymentCustomer');
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
    Route::get('/delete_payment/{id}', [AdminController::class, 'deletePayment'])->name('deletePayment');
    //export excel
    Route::get('/exportProvided', [AdminController::class, 'exportProvided'])->name('exportProvided');
    Route::get('/exportInvoice', [AdminController::class, 'exportInvoice'])->name('exportInvoice');
    Route::get('/exportProduct', [AdminController::class, 'exportProduct'])->name('exportProduct');
    Route::get('/exportStaff', [AdminController::class, 'exportStaff'])->name('exportStaff');

    //import excel
    Route::get('/importProvided', [AdminController::class, 'importProvided'])->name('importProvided');
    Route::post('/importProvided', [AdminController::class, 'postImportProvided'])->name('postImportProvided');

    //Thêm loại all
    Route::get('/update_security_type', [AdminController::class, 'updateSecurityType'])->name('updateSecurityType');
    Route::post('/update_security_type/{id}', [AdminController::class, 'postUpdateSecurityType'])->name('postUpdateSecurityType');
    Route::get('/update_feature_type', [AdminController::class, 'updateFeatureType'])->name('updateFeatureType');
    Route::post('/update_feature_type/{id}', [AdminController::class, 'postUpdateFeatureType'])->name('postUpdateFeatureType');
    Route::get('/update_record_type', [AdminController::class, 'updateRecordType'])->name('updateRecordType');
    Route::post('/update_record_type/{id}', [AdminController::class, 'postUpdateRecordType'])->name('postUpdateRecordType');
    Route::get('/update_video_type', [AdminController::class, 'updateVideoType'])->name('updateVideoType');
    Route::post('/update_video_type/{id}', [AdminController::class, 'postUpdateVideoType'])->name('postUpdateVideoType');
    Route::get('/update_music_type', [AdminController::class, 'updateMusicType'])->name('updateMusicType');
    Route::post('/update_music_type/{id}', [AdminController::class, 'postUpdateMusicType'])->name('postUpdateMusicType');
    Route::get('/update_camera_feature_type', [AdminController::class, 'updateCameraFeatureType'])->name('updateCameraFeatureType');
    Route::post('/update_camera_feature_type/{id}', [AdminController::class, 'postUpdateCameraFeatureType'])->name('postUpdateCameraFeatureType');
    Route::get('/update_wjfj_type', [AdminController::class, 'updateWjfjType'])->name('updateWjfjType');
    Route::post('/update_wjfj_type/{id}', [AdminController::class, 'postUpdateWjfjType'])->name('postUpdateWjfjType');
    Route::get('/update_gps_type', [AdminController::class, 'updateGpsType'])->name('updateGpsType');
    Route::post('/update_gps_type/{id}', [AdminController::class, 'postUpdateGpsType'])->name('postUpdateGpsType');
    Route::get('/update_bluetooth_type', [AdminController::class, 'updateBluetoothType'])->name('updateBluetoothType');
    Route::post('/update_bluetooth_type/{id}', [AdminController::class, 'postUpdateBluetoothType'])->name('postUpdateBluetoothType');
    Route::get('/update_film_type', [AdminController::class, 'updateFilmType'])->name('updateFilmType');
    Route::post('/update_film_type/{id}', [AdminController::class, 'postUpdateFilmType'])->name('postUpdateFilmType');
    Route::get('/update_battery_technology_type', [AdminController::class, 'updateBatteryTechnologyType'])->name('updateBatteryTechnologyType');
    Route::post('/update_battery_technology_type/{id}', [AdminController::class, 'postUpdateBatteryTechnologyType'])->name('postUpdateBatteryTechnologyType');
    Route::get('/update_product_type', [AdminController::class, 'updateProductType'])->name('updateProductType');
    Route::post('/update_product_type/{id}', [AdminController::class, 'postUpdateProductType'])->name('postUpdateProductType');
    Route::get('/update_payment', [AdminController::class, 'updatePayment'])->name('updatePayment');
    Route::post('/update_payment/{id}', [AdminController::class, 'postUpdatePayment'])->name('postUpdatePayment');
});
Route::get('/demo', [AdminController::class, 'demo'])->name('demo');
