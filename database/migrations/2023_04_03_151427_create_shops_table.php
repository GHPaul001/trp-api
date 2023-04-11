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
        Schema::create('shops', function (Blueprint $table) {
            $table->id();
            $table->integer('user_id');
            $table->string('name',200)->nullable();
            $table->string('logo')->nullable();
            $table->longText('sliders')->nullable();
            $table->string('phone')->nullable();
            $table->string('address',500)->nullable();
            $table->double('rating')->default(0.00);
            $table->integer('num_of_reviews')->default(0);
            $table->integer('num_of_sales')->default(0);
            $table->integer('seller_package_id')->nullable();
            $table->integer('product_upload_limit')->default(0);
            $table->date('package_invalid_at')->nullable();
            $table->integer('verification_status')->default(0);
            $table->longText('verification_info')->nullable();
            $table->integer('cash_on_delivery_status')->default(0);
            $table->double('admin_to_pay')->default(0.00);
            $table->string('facebook')->nullable();
            $table->string('instagram')->nullable();
            $table->string('google')->nullable();
            $table->string('twitter')->nullable();
            $table->string('youtube')->nullable();
            $table->string('slug')->nullable();
            $table->string('meta_title')->nullable();
            $table->text('meta_desription')->nullable();
            $table->text('pick_up_point_id')->nullable();
            $table->double('shipping_cost')->default(0.00);
            $table->float('delivery_pickup_latitude')->nullable();
            $table->float('delivery_pickup_longitude')->nullable();
            $table->string('bank_name')->nullable();
            $table->string('bank_acc_name',200)->nullable();
            $table->string('bank_acc_no',50)->nullable();
            $table->integer('bank_routing_no')->nullable();
            $table->integer('bank_payment_status')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('shops');
    }
};
