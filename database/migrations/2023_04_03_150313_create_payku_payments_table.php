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
        Schema::create('payku_payments', function (Blueprint $table) {
            $table->string('transaction_id',191);
            $table->date('start_date');
            $table->date('end_date');
            $table->string('media',191);
            $table->string('transaction_key')->nullable();
            $table->string('payment_key')->nullable();
            $table->string('verification_key',191);
            $table->string('authorization_code',191);
            $table->integer('last_4_digits')->nullable();
            $table->string('installments',191)->nullable();
            $table->string('card_type')->nullable();
            $table->string('additional_parameters')->nullable();
            $table->string('currency');
            $table->timestamps();
            
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('payku_payments');
    }
};
