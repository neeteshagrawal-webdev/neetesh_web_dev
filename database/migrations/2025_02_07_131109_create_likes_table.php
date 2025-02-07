<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
{
    Schema::create('likes', function (Blueprint $table) {
        $table->id();
        $table->foreignId('user_id')->constrained()->onDelete('cascade');
        $table->foreignId('vlog_id')->constrained()->onDelete('cascade');
        $table->enum('type', ['like', 'dislike']); // Like or Dislike
        $table->timestamps();

        $table->unique(['user_id', 'vlog_id']); // Ensure one like/dislike per user per vlog
    });
}


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('likes');
    }
};
