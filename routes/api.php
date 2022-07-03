<?php

use App\Http\Controllers\AdminController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\DB;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the 'api' middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
Route::get('/api',function(){
    $label=['Tháng 1', 'Tháng 2', 'Tháng 3', 'Tháng 4', 'Tháng 5', 'Tháng 6'];
    $product=DB::table('products')->select('id')->take(6)->get();
    return response()->json(['data'=>[
        'label'=>$label,
        'product'=> $product
    ]]);
});
Route::get('/product', function(){
    $product=App\Models\Product::with(
        'configuration.imageDetail',
        'configuration.frontCamera.frontCameraFeature',
        'configuration.rearCamera.rearCameraFeature',
        'configuration.rearCamera.film',
        'configuration.operatingSystemCpu',
        'configuration.memory',
        'configuration.information',
        'configuration.connection',
        'configuration.pin',
        'configuration.utilitie.securityAdvance',
        'configuration.utilitie.featureAdvance',
        'configuration.utilitie.record',
        'configuration.utilitie.video',
        'configuration.utilitie.music',
        )->get();
        return response()->json($product);
});
