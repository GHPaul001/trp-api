<?php

use App\Http\Controllers\AddonsController;
use App\Http\Controllers\AttributeController;
use App\Http\Controllers\BlogCategoryController;
use App\Http\Controllers\BrandsController;
use App\Http\Controllers\BusinessSettingController;
use App\Http\Controllers\CarrierController;
use App\Http\Controllers\CarrierPriceRangeController;
use App\Http\Controllers\CarrierRangeController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ColorController;
use App\Http\Controllers\ConversationController;
use App\Http\Controllers\CouponController;
use App\Http\Controllers\CouponUsageController;
use App\Http\Controllers\FlashDealController;
use App\Http\Controllers\LanguageController;
use App\Http\Controllers\NotificationController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\PageController;
use App\Http\Controllers\ReviewController;
use App\Http\Controllers\SubscriberController;
use App\Http\Controllers\TaxController;
use App\Http\Controllers\TicketController;
use App\Http\Controllers\TranslationController;
use App\Http\Controllers\UploadController;
use App\Http\Controllers\UserController;
use App\Models\Attribute;
use App\Models\Brands;
use App\Models\CarrierPriceRange;
use App\Models\Conversation;
use App\Models\FlashDeal;
use App\Models\Product;
use App\Models\Tax;
use App\Models\Upload;
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
    Route::get('/level0/{id}', [CategoryController::class,'getStock'])->name('getStock');
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

Route::prefix('reviews')->group(function() {
    Route::get('/getallreviews', [ReviewController::class,'getModifiedSearch'])->name('getModifiedSearch');
    Route::get('/brands', [ReviewController::class,'getBrandReview'])->name('getBrandReview');
    Route::get('/categories', [ReviewController::class,'getCategoryReview'])->name('getCategoryReview');
    Route::get('/attributes/{id}', [ReviewController::class,'getCategoriesAttribute'])->name('getCategoriesAttribute');
});

Route::prefix('colors')->group(function() {
    Route::get('/', [ReviewController::class,'getalldigitalproducts'])->name('getalldigitalproducts');
    Route::get('/categories', [CategoryController::class,'getdigitalcategories'])->name('getdigitalcategories');
    Route::get('/tax', [TaxController::class,'getallcolors'])->name('getallcolors');
});

Route::prefix('uploads')->group(function() {
    Route::get('/', [UploadController::class,'getalldigitalproducts'])->name('getalldigitalproducts');
    Route::get('/categories', [CategoryController::class,'getdigitalcategories'])->name('getdigitalcategories');
    Route::get('/tax', [TaxController::class,'getallcolors'])->name('getallcolors');
});

Route::apiResource('attributes',AttributeController::class);
Route::apiResource('addons',AddonsController::class);
Route::apiResource('brands',BrandsController::class);
Route::apiResource('business_settings',BusinessSettingController::class);
Route::apiResource('blog_categories',BlogCategoryController::class); 
Route::apiResource('conversations',ConversationController::class);
Route::apiResource('cart', CartController::class);
Route::apiResource('categories', CategoryController::class);
Route::apiResource('carriers', CarrierController::class);
Route::apiResource('carriers_range', CarrierRangeController::class);
Route::apiResource('carriers_range_price', CarrierPriceRangeController::class);
Route::apiResource('categories', CategoryController::class);
Route::apiResource('coupons', CouponController::class);
Route::apiResource('products',ProductController::class);
Route::apiResource('colors',ColorController::class);
Route::apiResource('languages',LanguageController::class);
Route::apiResource('staffs',LanguageController::class);
Route::apiResource('orders',OrderController::class);
Route::apiResource('users',UserController::class);
Route::apiResource('uploads',UploadController::class); 
Route::apiResource('subscribers',SubscriberController::class);
Route::apiResource('tickets',TicketController::class);
Route::apiResource('pages',PageController::class);
Route::apiResource('reviews',ReviewController::class);
Route::apiResource('translations',TranslationController::class);
Route::apiResource('flash_deals',FlashDealController::class);
Route::apiResource('notifications',NotificationController::class);
// Route::get('/cart', [UserController::class, 'index']);