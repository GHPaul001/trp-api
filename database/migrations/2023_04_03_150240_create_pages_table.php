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
        Schema::create('pages', function (Blueprint $table) {
            $table->id();
            $table->string('type',50);
            $table->string('title')->nullable();
            $table->string('slug')->nullable();
            $table->longText('content')->nullable();
            $table->text('meta_title')->nullable();
            $table->string('meta_description',1000)->nullable();
            $table->string('keyword',1000)->nullable();
            $table->string('meta_image')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pages');
    }
};
