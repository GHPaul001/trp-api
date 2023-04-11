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
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->integer('combined_id')->nullable();
            $table->integer('user_id')->nullable();
            $table->integer('guest_id')->nullable();
            $table->integer('seller_id')->nullable();
            $table->longText('shipping_address')->nullable();
            $table->longText('additional_info')->nullable();
            $table->string('shipping_type',50);
            $table->integer('pickup_point_id');
            $table->integer('carrier_id')->nullable();
            $table->string('delivery_status',20)->default('pending')->nullable();
            $table->string('payment_type',20)->nullable();
            $table->string('payment_status',20)->default('unpaid')->nullable();
            $table->longText('payment_details')->nullable();
            $table->double('grand_total')->nullable();
            $table->double('coupon_discount')->default(0.00);
            $table->mediumText('code')->nullable();
            $table->string('tracking_code')->nullable();
            $table->integer('date');
            $table->integer('viewed')->default(0);
            $table->integer('delivery_viewed')->default(1);
            $table->integer('payment_status_viewed')->default(1)->nullable();
            $table->integer('commission_calculated')->default(0);
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
