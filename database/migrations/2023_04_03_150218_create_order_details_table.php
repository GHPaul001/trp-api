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
        Schema::create('order_details', function (Blueprint $table) {
            $table->id();
            $table->integer('order_id');
            $table->integer('seller_id')->nullable();
            $table->integer('product_id');
            $table->longText('variation')->nullable();
            $table->double('price')->default(0.00);
            $table->double('tax')->default(0.00);
            $table->double('shipping_cost')->default(0.00);
            $table->integer('quantity');
            $table->string('payment_status',10)->default('unpaid');
            $table->string('delivery_status',20)->default('pending')->nullable();
            $table->string('shipping_type')->nullable();
            $table->integer('pickup_point_id')->nullable();
            $table->integer('product_referral_code')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('order_details');
    }
};
