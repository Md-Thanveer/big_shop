<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

use App\Enums\OrderStatus;
use App\Enums\PaymentMethod;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('customer_id');
            $table->string('order_number');
            $table->timestamp('order_date')->useCurrent();
            $table->decimal('total_amount', 10,2);
            $table->string('order_status')->default(OrderStatus::APPOINTMENT);
            $table->string('payment_method')->default(PaymentMethod::CASH);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
};
