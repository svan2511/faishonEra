<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\BrandController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ColorController;
use App\Http\Controllers\CouponController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\SizeController;
use App\Http\Controllers\SubCategoryController;
use App\Http\Controllers\TaxController;

use Illuminate\Support\Facades\Route;

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

Route::get('test',[HomeController::class , 'test']);


Route::group(['middleware'=> 'pass_data_to_front_views'],function()
{
    Route::get('/', [HomeController::class , 'index'] );
    Route::get('shop', [HomeController::class , 'shopPage'] );
    Route::post('shop', [HomeController::class , 'shopPage'] );
    Route::get('cart', [HomeController::class , 'cartPage'] );
    Route::get('product/{slug}' , [HomeController::class , 'single_product'] );
    Route::post('add_cart' , [HomeController::class , 'add_cart'] );
    Route::post('cart_del',[HomeController::class , 'cart_del']);
    Route::post('cart_update',[HomeController::class , 'cart_update']);
    Route::post('checkout',[HomeController::class , 'checkout']);
    Route::post('placed_order',[HomeController::class,'placed_order']);
    Route::get('order/details' , [HomeController::class , 'getOrderDetails'] );
    
    Route::post('check_coupon',[HomeController::class , 'check_coupon']);

});



Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', function () {
    return view('dashboard');
})->name('dashboard');

 

// Admin Routes 

Route::get('admin/dashboard', [ AdminController::class , 'index' ])->name('dash');

Route::resource('categories' , CategoryController::class );
Route::resource('colors' , ColorController::class );
Route::resource('coupons' , CouponController::class );
Route::resource('taxes' , TaxController::class );
Route::resource('sizes' , SizeController::class );
Route::resource('products' , ProductController::class);
Route::get('attributes/{id}/{proId}' , [ProductController::class , 'delete_attribute'] );
Route::resource('subcategories' , SubCategoryController::class );
Route::resource('brands' , BrandController::class );
Route::get('admin/catStatus/{id}/{status}', [ CategoryController::class , 'catStatus' ]);
Route::get('admin/subcatStatus/{id}/{status}', [ SubCategoryController::class , 'catStatus' ]);
Route::get('admin/colorStatus/{id}/{status}', [ ColorController::class , 'colorStatus' ]);
Route::get('admin/sizeStatus/{id}/{status}', [ SizeController::class , 'sizeStatus' ]);
Route::post('change_subcat',[ProductController::class,'change_subcat']);
Route::get('admin/couponStatus/{id}/{status}', [ CouponController::class , 'couponStatus' ]);

