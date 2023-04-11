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
        Schema::create('proxypay_payments', function (Blueprint $table) {
            $table->id();
            $table->string('payment_type',20);
            $table->string('reference_id',20);
            $table->integer('order_id')->nullable();
            $table->integer('package_id')->nullable();
            $table->integer('user_id');
            $table->double('amount')->default(0.00);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('proxypay_payments');
    }
};
