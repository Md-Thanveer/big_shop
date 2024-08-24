<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;


use App\Models\Product;
use App\Models\Category;

use Illuminate\Database\Eloquent\ModelNotFoundException;

class HomeController extends Controller
{
    public function index(Request $request)
    {
        return view('frontend/home');
    }


}