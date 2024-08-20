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