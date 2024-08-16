<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

use Illuminate\Support\Facades\Storage;

class Category extends Model
{
    use HasFactory;

    protected $table ='categories';

    protected $fillable =[
        'name',
        'description',
        'status',
        'image_path',
        'buying_price',
        'selling_price',
        'expected_profit',
        'earned_profit',
        'company_id',
    ];

    public function company()
    {
        return $this->belongsTo(Company::class, 'company_id');
    }

    public function subcategories()
    {
        return $this->hasMany(SubCategory::class, 'category_id');
    }

    public function getImagePath()
    {
        return env('DOMAIN_URL') . Storage::url($this->image_path);
    }

    public function getSubCategoryCountAttribute(): int
    {
        return $this->subcategories()->count();
    }
    
}
