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

    Schema::create('vlogs', function (Blueprint $table) {
        $table->id();
        $table->string('title'); // Vlog ka title
        $table->text('description'); // Vlog ka description
        $table->string('image')->nullable(); // Image optional
        $table->integer('like')->default(0); // Default 0 likes
        $table->integer('dislike')->default(0); // Default 0 dislikes
        $table->integer('user_id');
        $table->timestamps(); // created_at & updated_at
    });
}


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('vlogs');
    }
};
