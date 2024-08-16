<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');


use App\Http\Controllers\api\v2\ProductController;

Route::get('/products',[ProductController::class,'index']);


use App\Http\Controllers\api\v2\BrandController;

Route::get('/brands',[BrandController::class,'index']);


use App\Http\Controllers\api\v2\CategoryController;

Route::get('/categories',[CategoryController::class,'index']);

use App\Http\Controllers\api\v2\SubCategoryController;

Route::get('/subcategories',[SubCategoryController::class,'index']);





