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
        Schema::create('seller_withdraw_requests', function (Blueprint $table) {
            $table->id();
            $table->integer('user_id')->nullable();
            $table->double('amount')->nullable();
            $table->longText('message')->nullable();
            $table->integer('status')->nullable();
            $table->integer('viewed')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('seller_withdraw_requests');
    }
};
