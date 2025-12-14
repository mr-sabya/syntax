<?php

use Illuminate\Support\Facades\Route;

// login route for admins
Route::get('login', [App\Http\Controllers\Frontend\AuthController::class, 'login'])->name('login');
Route::get('register', [App\Http\Controllers\Frontend\AuthController::class, 'register'])->name('register');

// home page
Route::get('/', [App\Http\Controllers\Frontend\HomeController::class, 'index'])->name('home');

// shop page
Route::get('/shop', [App\Http\Controllers\Frontend\ShopController::class, 'index'])->name('shop');

// product show
Route::get('/product/{slug}', [App\Http\Controllers\Frontend\ProductController::class, 'show'])->name('product.show');

// category page
Route::get('/category', [App\Http\Controllers\Frontend\CategoryController::class, 'index'])->name('category');

// flash deals page
Route::get('/hot-offers', [App\Http\Controllers\Frontend\HotOffersController::class, 'index'])->name('hot-offers');

// blog page
Route::get('/blog', [App\Http\Controllers\Frontend\BlogController::class, 'index'])->name('blog');

// blog show page
Route::get('/blog/{slug}', [App\Http\Controllers\Frontend\BlogController::class, 'show'])->name('blog.show');

// contact page
Route::get('/contact', [App\Http\Controllers\Frontend\ContactController::class, 'index'])->name('contact');

// about page
Route::get('/about', [App\Http\Controllers\Frontend\AboutController::class, 'index'])->name('about');

// cart page
Route::get('/cart', [App\Http\Controllers\Frontend\CartController::class, 'index'])->name('cart');

// software page
Route::get('/software', [App\Http\Controllers\Frontend\SoftwareController::class, 'index'])->name('software');
Route::get('/software/{slug}', [App\Http\Controllers\Frontend\SoftwareController::class, 'show'])->name('software.show');

// partners page
Route::get('/partners', [App\Http\Controllers\Frontend\PartnerController::class, 'index'])->name('partners');

// clients page
Route::get('/clients', [App\Http\Controllers\Frontend\ClientController::class, 'index'])->name('clients');

// check middleware
Route::middleware('auth')->group(function () {
    Route::get('/profile', [App\Http\Controllers\Frontend\ProfileController::class, 'profile'])->name('profile');

    Route::get('/checkout', [App\Http\Controllers\Frontend\CheckoutController::class, 'index'])->name('checkout');

    Route::get('/thank-you/{orderId}', [App\Http\Controllers\Frontend\CheckoutController::class, 'thankYou'])->name('checkout.success');

    // track order page
});
Route::get('/track-order', [App\Http\Controllers\Frontend\OrderController::class, 'trackOrder'])->name('order.track');


