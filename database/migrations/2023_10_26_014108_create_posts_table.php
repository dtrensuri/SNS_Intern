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
        Schema::create('posts', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->foreign('user_id')->references('id')->on('users');
            $table->text('content')->nullable();
            $table->string('media_url')->nullable();
            $table->integer('total_impressions')->nullable();
            $table->integer('total_engaged')->nullable();
            $table->integer('total_reactions')->nullable();
            $table->integer('total_shares')->nullable();
            $table->string('post_id')->unique();
            $table->string('platform'); // Nền tảng xã hội
            $table->dateTime('scheduled_time')->nullable();
            $table->string('status'); // Ví dụ: "Chờ duyệt", "Đã đăng"
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('posts');
    }
};