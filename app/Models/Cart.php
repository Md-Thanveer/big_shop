<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    use HasFactory;

    protected $table='carts';

    protected $fillable = [
        'customer_id',
        'product_id',
        'qty',
    ];

    public function customer()
    {
        return $this->belongsTo(User::class, 'customer_id');
    }

    public function product()
    {
        return $this->belongsTo(User::class, 'product_id');
    }

    public function totalPrice()
    {
        return $this->qty * $this->product->price;
    }

    public static function grandTotal($customId)
    {
        $cartitems = Cart::where('customer_id', $customId)->get();
        $total = $cartitems->sum(function ($item){
            return $item->totalPrice();
        });

        return $total;
    }
}

