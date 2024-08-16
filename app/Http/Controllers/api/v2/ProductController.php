<?php

namespace App\Http\Controllers\api\v2;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $products = Product::orderBy('name', 'asc')->get();
        $transformedProducts = $products->map(function($row){
        return[
            'id' => $row->id,
            'name' => $row->name,
            'price' => $row->price,
            'description' => $row->description,
            'price' => $row->price,
            // 'brand'=>$product->brand->name ?? null,
            'image_path' => $row->getImagePath(),
            // 'qty'=>$product->qty,
            // 'alert_stock'=>$product->alert_stock,
        ];
    
    });
    return response()->json(['data'=> $transformedProducts],200);
}

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Product $product)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Product $product)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Product $product)
    {
        //
    }
}
