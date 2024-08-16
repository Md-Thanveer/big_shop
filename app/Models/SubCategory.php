<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

use Illuminate\Support\Facades\Storage;

class SubCategory extends Model
{
    use HasFactory;

    protected $table='sub_categories';

    protected $fillable =[

        'name',
        'description',
        'status',
        'image_path',
        'buying_price',
        'selling_price',
        'earned_profit',
        'measurement_unit',
        'current_qty',
        'reorder_level',
        'company_id',
        'category_id',
    
    ];

    public function company()
    {
        return $this->belongsTo(Company::class, 'company_id');
    }

    public function category()
    {
        return $this->belongsTo(Category::class, 'category_id');
    }

    public function getImagePath()
    {

        return env('DOMAIN_URL').Storage::url($this->image_path);
    }
}

