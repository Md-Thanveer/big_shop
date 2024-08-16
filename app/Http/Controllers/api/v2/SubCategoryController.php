<?php

namespace App\Http\Controllers\api\v2;

use App\Http\Controllers\Controller;
use App\Models\SubCategory;
use Illuminate\Http\Request;

class SubCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $subcategories = SubCategory::orderBy('name', 'asc')->get();
        $transformedSubCategories = $subcategories->map(function($row) {
            return [
                'id' => $row->id,
                'name' => $row->name,
                'description' => $row->description,
                'status'=> $row->status,
                'image_path'=>$row->image_path,
                'buying_price'=>$row->buying_price,
                'selling_price'=>$row->selling_price,
                'earned_profit'=>$row->earned_profit,
                'measurement_unit'=>$row->measurement_unit,
                'current_qty'=>$row->current_qty,
                'reorder_level'=>$row->reorder_level,
                'category'=>$row->category->name,
            
            ];  
        });
        return response()->json(['data' => $transformedSubCategories], 200);    
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
    public function show(SubCategory $subCategory)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, SubCategory $subCategory)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(SubCategory $subCategory)
    {
        //
    }
}
