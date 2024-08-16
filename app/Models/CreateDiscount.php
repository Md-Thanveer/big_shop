<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CreateDiscount extends Model
{
    use HasFactory;

    protected $table='create_discounts';

    protected $fillable=[

        'type',
        'start_date',
        'end_date',
        'never_experired'


    ];
}
