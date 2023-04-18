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
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->integer('referred_by')->nullable();
            $table->string('provider_id',50)->nullable();
            $table->string('user_type',20);
            $table->string('name',191);
            $table->string('email',191)->nullable();
            $table->timestamp('email_verified_at')->nullable();
            $table->text('verification_code')->nullable();
            $table->text('new_verification_code')->nullable();
            $table->string('password',191)->nullable();
            $table->string('remember_token',191)->nullable();
            $table->string('device_token')->nullable();
            $table->string('avatar',256)->nullable();
            $table->string('avatar_original',256)->nullable();
            $table->string('address',300)->nullable();
            $table->string('country',30)->nullable();
            $table->string('state',30)->nullable();
            $table->string('city',30)->nullable();
            $table->string('postal_code',20)->nullable();
            $table->string('phone',20)->nullable();
            $table->double('balance',20,2);
            $table->tinyInteger('banned');
            $table->string('referral_code');
            $table->integer('customer_package_id');
            $table->integer('remaining_uploads');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};
