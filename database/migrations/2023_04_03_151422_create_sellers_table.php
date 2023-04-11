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
        Schema::create('sellers', function (Blueprint $table) {
            $table->id();
            $table->integer('user_id');
            $table->double('rating')->default(0.00);
            $table->integer('num_of_reviews')->default(0);
            $table->integer('num_of_sales')->default(0);
            $table->integer('verification_status')->default(0);
            $table->longText('verification_info')->nullable();
            $table->integer('cast_on_delivery_status')->default(0);
            $table->double('admin_to_pay')->default(0.00);
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
        Schema::dropIfExists('sellers');
    }
};
