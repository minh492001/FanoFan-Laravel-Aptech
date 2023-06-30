<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */

    public function up(): void
    {
        Schema::create('fans', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('product_code');
            $table->float('price');
            $table->string('slug',1000)->nullable();
            $table->string('description',5000)->nullable();
            $table->string('about',5000)->nullable();
            $table->foreignId('type_id')->references('id')->on('fan_types');
            $table->foreignId('brand_id')->references('id')->on('brands');
            $table->foreignId('technical_id')->references('id')->on('technical_details');
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('fans');
    }
};
