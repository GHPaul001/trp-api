<?php

use App\Http\Controllers\AttributeController;
use App\Http\Controllers\BrandsController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ColorController;
use App\Http\Controllers\FlashDealController;
use App\Http\Controllers\LanguageController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\TaxController;
use App\Models\Attribute;
use App\Models\Brands;
use App\Models\FlashDeal;
use App\Models\Product;
use App\Models\Tax;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});


Route::prefix('dashboard')->group(function() {
    Route::get('/dashboard_count', [DashboardController::class,'dashboardDetails'])->name('dashboardDetails');
});

Route::prefix('categories')->group(function() {
    Route::get('/level0/stock', [CategoryController::class,'getStock'])->name('getStock');
});

Route::prefix('products')->group(function() {
    Route::get('/categories', [CategoryController::class,'getallcategories'])->name('getallcategories');
    Route::get('/brands', [BrandsController::class,'getBrandName'])->name('getBrandName');
    Route::get('/colors', [ColorController::class,'getallcolors'])->name('getallcolors');
    Route::get('/taxes', [TaxController::class,'getalltaxes'])->name('getalltaxes');
    Route::get('/attributes', [AttributeController::class,'getallattributes'])->name('getallattributes');
    Route::get('/flash-deals', [FlashDealController ::class,'getflashdealall'])->name('getflashdealall');
});

Route::prefix('digital_products')->group(function() {
    Route::get('/products', [ProductController::class,'getalldigitalproducts'])->name('getalldigitalproducts');
    Route::get('/categories', [CategoryController::class,'getdigitalcategories'])->name('getdigitalcategories');
    Route::get('/tax', [TaxController::class,'getdigitaltaxes'])->name('getdigitaltaxes');
});

Route::prefix('colors')->group(function() {
    Route::get('/', [ColorController::class,'getalldigitalproducts'])->name('getalldigitalproducts');
    Route::get('/categories', [CategoryController::class,'getdigitalcategories'])->name('getdigitalcategories');
    Route::get('/tax', [TaxController::class,'getallcolors'])->name('getallcolors');
});

Route::apiResource('attributes',AttributeController::class);
Route::apiResource('cart', CartController::class);
Route::apiResource('categories', CategoryController::class);
Route::apiResource('products',ProductController::class);
Route::apiResource('brands',BrandsController::class);
Route::apiResource('colors',ColorController::class);
Route::apiResource('languages',LanguageController::class);
Route::apiResource('staffs',LanguageController::class);
Route::apiResource('orders',OrderController::class);
Route::apiResource('users',User::class);


// Route::get('/cart', [UserController::class, 'index']);