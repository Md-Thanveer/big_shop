<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Order extends Model
{
    use HasFactory;

    protected $table = 'orders';

    protected $fillable = [
        
        'customer_id',
        'order_number',
        'order_date',
        'total_amount',
        'order_status',
        'payment_method'
    ];

    public static function boot()
    {
        parent::boot();

        //Addingt an event listener for the "creating" event
        static::creating(function ($order){

            // Generate the order number with the desired format(yyyy/mm/dd/nnn)
            $datePart = now()->format('ymd');
            $sequentialPart = str_pad(static::max('order_number') % 1000 + 1, 3, '0', STR_PAD_LEFT);
            $order->order_number = $datePart . $sequentialPart;

            // Set the order_date attribute to the current date and time
            $order->order_date = now();
        });
    }

        public function customer(): BelongsTo
        {
            return $this->belongsTo(User::class, 'customer_id');
        }

        public function orderItems()
        {
            return $this->hasMany(OrderItem::class);
        }

        public function products(): BelongsToMany
        {
            return $this->belongsToMany(Product::class);
        }

        /**
         * Calculate CGST (6%)
         * 
         * @return float
         */
        public function calculateCGST(): float
        {
            return $this->total_amount * 0.06;
        }

        /**
         * Convert the total amount to words using NumberToWords library
         * 
         * @return string
         */
        public function getTotalAmountInWords(): string
        {
            $numberToWords = new NumberToWords();
            $transformer = $numberToWords->getNumberTransformer('en');

            return $transformer->toWords($this->total_amount);
        }

        /**
         * Convert the tax amount to words using NumberToWords library
         * 
         * @param float $taxAmount
         * return string
         */
        public function convertTaxAmountToWords($taxAmount): string
        {
            $numberToWords = new NumberToWords();
            $transformer = $numberToWords->getNumberTransformer('en');

            return $transformer->toWords($taxAmount);
        }

}
