<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

use App\Enums\StockStatus;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('products', function (Blueprint $table) {
            $table->id();

            $table->string('name');
            $table->string('description')->nullable();
            $table->decimal('price',10,2)->nullable();
            $table->unsignedBigInteger('category_id')->nullable();
            $table->unsignedBigInteger('brand_id')->nullable();
            $table->unsignedBigInteger('product_label_id')->nullable();
            $table->unsignedBigInteger('product_tag_id')->nullable();
            $table->string('image_path')->default('noimage.jpeg')->nullable();
            $table->integer('qty')->nullable();
            $table->integer('alert_stock')->default(0)->nullable();
            $table->string('stock_status')->default(StockStatus::InStock)->nullable();
            $table->string('is_featured')->default(false)->nullable();
            $table->string('min_order_qty')->default(0)->nullable();
            $table->string('max_order_qty')->default(0)->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};
