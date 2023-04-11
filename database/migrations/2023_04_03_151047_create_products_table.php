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
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->string('name',200);
            $table->string('added_by',6)->default('admin');
            $table->integer('user_id');
            $table->integer('category_id');
            $table->integer('brand_id')->nullable();
            $table->string('photos',2000)->nullable();
            $table->string('thumbnail_img',100)->nullable();
            $table->string('video_provider',20)->nullable();
            $table->string('video_link',100)->nullable();
            $table->string('tag',500)->nullable();
            $table->longText('description')->nullable();
            $table->double('unit_price');
            $table->double('purchas_price')->nullable();
            $table->integer('variant_product')->default(0);
            $table->string('attributes',1000)->default('[]');
            $table->mediumText('choice_options')->nullable();
            $table->mediumText('color')->nullable();
            $table->text('variations')->nullable();
            $table->integer('todays_deal')->default(0);
            $table->integer('published')->default(1);
            $table->tinyInteger('approved')->default(1);
            $table->string('stock_visibility_state',10)->default('quantity');
            $table->tinyInteger('cash_on_delivery')->default(0);
            $table->integer('featured')->default(0);
            $table->integer('seller_featured')->default(0);
            $table->integer('current_stock')->default(0);
            $table->string('unit',20)->nullable();
            $table->double('weight')->default(0.00);
            $table->integer('min_qty')->default(1);
            $table->integer('low_stock_quantity')->nullable();
            $table->double('discount')->nullable();
            $table->string('discount_type',10)->nullable();
            $table->integer('discount_start_date')->nullable();
            $table->integer('discount_end_date')->nullable();
            $table->double('tax')->nullable();
            $table->string('tax_type',10)->nullable();
            $table->string('shipping_type')->default('flat_rate');
            $table->double('shipping_cost')->default(0.00);
            $table->tinyInteger('is_quantity_multiplied')->default(0);
            $table->integer('est_shipping_days')->nullable();
            $table->integer('num_of_sales')->default(0);
            $table->mediumInteger('meta_title')->nullable();
            $table->longText('meta_description')->nullable();
            $table->string('meta_img')->nullable();
            $table->string('pdf')->nullable();
            $table->mediumInteger('slug');
            $table->double('ratting')->default(0.00);
            $table->string('barcode')->nullable();
            $table->integer('digital')->default(0);
            $table->integer('auction_product')->default(0);
            $table->string('file_name')->nullable();
            $table->string('file_path')->nullable();
            $table->string('external_link')->nullable();
            $table->string('external_link_btn')->default('Buy Now')->nullable();
            $table->integer('wholesale_product')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};
