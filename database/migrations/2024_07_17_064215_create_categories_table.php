<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

use App\Enums\CategoryStatus;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('categories', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('description')->nullable();
            $table->string('status')->default(CategoryStatus::PUBLISHED)->nullable();
            $table->string('image_path')->default('noimage.jpeg')->nullable();
            $table->double('buying_price')->nullable();
            $table->double('selling_price')->nullable();
            $table->double('expected_profit')->nullable();
            $table->double('earned_profit')->nullable();
            $table->unsignedBigInteger('company_id')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('categories');
    }
};
