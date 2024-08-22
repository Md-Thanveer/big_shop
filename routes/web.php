<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

use App\Http\Controllers\HomeController;

Route::get('/',[HomeController::class, 'index'])->name('home.index');


use App\Http\Controllers\AuthController;

Route::get('/forget_password',[AuthController::class, 'forget_password'])->name('home.forget_password');


Route::get('/login', [AuthController::class, 'login'])->name('home.login');

Route::get('/register', [AuthController::class, 'register'])->name('home.register');

Route::get('/resetpassword',[AuthController::class, 'reset_password'])->name('home.reset_password');

Route::get('/myaccount',[AuthController::class, 'my_account'])->name('home.my_account');

Route::get('/privacypolicy',[AuthController::class, 'privacy_policy'])->name('home.privacy_policy');

Route::get('/terms',[AuthController::class, 'terms'])->name('home.terms');


Route::get('/error',[AuthController::class, 'error'])->name('home.page_not_found');


use App\Http\Controllers\CartController;

// Cart listing page
Route::get('/cart', [CartController::class, 'index'])->name('cart.index');

// Add to Cart
Route::post('/cart/add_to_cart', [CartController::class, 'add_to_cart'])->name('cart.add_to_cart');

// Increase quantity route
Route::post('/cart/increase/{id}', [CartController::class, 'increaseQuantity'])->name('cart.increase');

// Decrease quantity route
Route::post('/cart/decrease/{id}', [CartController::class, 'decreaseQuantity'])->name('cart.decrease');

// Remove item from cart
Route::delete('/cart/{id}', [CartController::class, 'removeFromCart'])->name('cart.remove');

// Checkout route (if you have a checkout process)
// Route::get('/checkout', [CheckoutController::class, 'index'])->name('checkout');

// Clear cart route
Route::post('/cart/clear', [CartController::class, 'clearCart'])->name('cart.clear');