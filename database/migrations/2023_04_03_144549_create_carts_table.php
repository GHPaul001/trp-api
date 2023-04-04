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
        Schema::create('carts', function (Blueprint $table) {
            $table->id();
            $table->integer('owner_id')->nullable();
            $table->integer('user_id')->nullable();
            $table->string('temp_user_id')->nullable();
            $table->integer('address_id')->default(0);
            $table->integer('product_id')->nullable();
            $table->text('variation')->nullable();
            $table->double('price')->default(0.00)->nullable();
            $table->double('tax')->default(0.00)->nullable();
            $table->double('shipping_cost')->default(0.00);
            $table->string('shipping_type');
            $table->integer('pickup_point')->nullable();
            $table->integer('carrier_id')->nullable();
            $table->double('discount')->default(0.00);
            $table->string('product_referral_code')->nullable();
            $table->string('coupon_code')->nullable();
            $table->tinyInteger('coupon_applied')->default(0);
            $table->string('quantity')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('carts');
    }
};
