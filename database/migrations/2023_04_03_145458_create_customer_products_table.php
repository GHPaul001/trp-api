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
        Schema::create('customer_products', function (Blueprint $table) {
            $table->id();
            $table->string('name')->nullable();
            $table->integer('published')->default(0);
            $table->integer('status')->default(0);
            $table->string('added_by',50)->nullable();
            $table->integer('user_id')->nullable();
            $table->integer('category_id')->nullable();
            $table->integer('subcategory_id')->nullable();
            $table->integer('subsubcategory_id')->nullable();
            $table->integer('brand_id')->nullable();
            $table->string('photos')->nullable();
            $table->string('thumbnail_img',150)->nullable();
            $table->string('condition',50)->nullable();
            $table->text('location')->nullable();
            $table->string('video_provider',100)->nullable();
            $table->string('video_link',200)->nullable();
            $table->string('unit',200)->nullable();
            $table->string('tags')->nullable();
            $table->mediumText('description')->nullable();
            $table->double('unit_price')->default(0.00)->nullable();
            $table->string('meta_title',200)->nullable();
            $table->string('meta_description',500)->nullable();
            $table->string('meta_img',150)->nullable();
            $table->string('pdf',200)->nullable();
            $table->string('slug',200)->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('customer_products');
    }
};
