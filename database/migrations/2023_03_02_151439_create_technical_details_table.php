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
        Schema::create('technical_details', function (Blueprint $table) {
            $table->id();
            $table->string('width',10)->nullable();
            $table->integer('wind_speed')->nullable();
            $table->string('wind_flow')->nullable();
            $table->integer('number_of_fans')->nullable();
            $table->string('fan_materials')->nullable();
            $table->string('color')->nullable();
            $table->string('weigh')->nullable();
            $table->string('from')->nullable();
            $table->string('manufacturer')->nullable();
            $table->string('guarantee')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('technical_details');
    }
};
