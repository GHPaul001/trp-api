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
        Schema::create('carrier_ranges', function (Blueprint $table) {
            $table->id();
            $table->integer('carrier_id');
            $table->string('billing_type',20);
            $table->integer('delimeter_1');
            $table->integer('delimeter_2');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('carrier_ranges');
    }
};
