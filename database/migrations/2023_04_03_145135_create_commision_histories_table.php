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
        Schema::create('commision_histories', function (Blueprint $table) {
            $table->id();
            $table->integer('order_id');
            $table->integer('order_detail_id');
            $table->integer('seller_id');
            $table->double('admission_commission');
            $table->double('seller_earning');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('commision_histories');
    }
};
