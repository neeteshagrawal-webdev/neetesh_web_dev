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
    Schema::create('comments', function (Blueprint $table) {
        $table->id();
        $table->unsignedBigInteger('vlog_id'); // Kis Vlog post par comment kiya gaya
        $table->unsignedBigInteger('user_id'); // Kis user ne comment kiya
        $table->text('comment'); // Comment text
        $table->timestamps();

        // Foreign Keys
        $table->foreign('vlog_id')->references('id')->on('vlogs')->onDelete('cascade');
        $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
    });
}


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('comments');
    }
};
