<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Artisan;
use App\Http\Controllers\Frontend\FrontpageController;

Route::group(['as' => 'frontend.'], function () {
    Route::get('/', [FrontpageController::class, 'home'])->name('home');
    Route::get('/quick-view', [FrontpageController::class, 'quickView'])->name('quick-view');
    Route::get('/products/{slug?}', [FrontpageController::class, 'products'])->name('products');
    Route::get('/search', [FrontpageController::class, 'search'])->name('search');
    Route::get('/product-filter', [FrontpageController::class, 'productFilter'])->name('product-filter');
    Route::get('/flash-deal/{slug?}', [FrontpageController::class, 'flashDeal'])->name('flash-deal');
    Route::get('/flash-deal/{deal}/{slug}', [FrontpageController::class, 'singleDealProduct'])->name('single-deal-product');
    Route::get('/brand/{slug}', [FrontpageController::class, 'brandProducts'])->name('brand-products');
    Route::get('/product/{slug}', [FrontpageController::class, 'singleProduct'])->name('single-product');
    Route::post('/product/get-variant-price', [FrontpageController::class, 'getVariantPrice'])->name('product.variant-price');
    Route::get('/page/{slug}', [FrontpageController::class, 'page'])->name('page');
});


// ------------ utility start ----------
Route::get('/clear', function () {
    Artisan::call('cache:clear');
    Artisan::call('config:clear');
    Artisan::call('config:cache');
    Artisan::call('view:clear');
    Artisan::call('route:clear');
    Artisan::call('clear-compiled');
    return redirect()->back()->withSuccessMessage('Cleared Successfully!');
});

Route::get('/storage-link', function () {
    Artisan::call('storage:link');
    return redirect()->back()->withSuccessMessage('Linked Successfully!');
});

// ------------ utility end ----------

// include_once('reseller.php');