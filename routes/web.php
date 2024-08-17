<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

use App\Http\Controllers\HomeController;

Route::get('/',[HomeController::class, 'index'])->name('home.index');

use App\Http\Controllers\AuthController;

Route::get('/forget_password',[AuthController::class, 'forget_password'])->name('home.forget_password');


Route::get('/login', [HomeController::class, 'login'])->name('home.login');
