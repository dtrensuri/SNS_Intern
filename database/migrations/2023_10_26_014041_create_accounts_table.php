<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('accounts', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->foreign('user_id')->references('id')->on('users');
            $table->string('id_account')->nullable();
            $table->string('name_account')->nullable();
            $table->string('platform');
            $table->string('access_token')->nullable();
            $table->string('refresh_token')->nullable();
            $table->string('consumer_key')->nullable();
            $table->string('consumer_secret')->nullable();
            $table->string('bearer_token')->nullable();
            $table->string('status')->nullable();
            $table->dateTime('token_expiration')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('accounts');
    }
};