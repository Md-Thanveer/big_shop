<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

use Illuminate\Support\Facades\Storage;

class Product extends Model
{
    use HasFactory;
    
    protected $table = 'products';
    
    protected $fillable = [
        'name',
        'price',
        'category_id',
        'brand_id',
        'product_label_id',
        'qty',
        'id',
        'alert_stock',
        'image_path',
        'description',
        
    ];

    // public function category(): BelongsTo
    // {
    //     return $this->belongsTo(Category::class,'category_id');
    // }

    public function category()
    {
        return $this->belongsToMany(Category::class, 'product_categories');
    }


    public function brand(): BelongsTo
    {
        return $this->belongsTo(Brand::class,'brand_id');
    }

    public function productLabel()
    {
        return $this->belongsToMany(Label::class,'product_labels');
    }

    public function productTag()
    {
        return $this->belongsToMany(Tag::class,'product_tags');
    }

    public function productCollection()
    {
        return $this->belongsToMany(Collection::class,'product_collections');
    }

    public function GetImagePath()
    {
        return env('DOMAIN_URL') . Storage::url($this->image_path);
    }
}
