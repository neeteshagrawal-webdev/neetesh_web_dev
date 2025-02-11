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
        Schema::create('downloadhistory', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id')->nullable(); // ID of the user who downloaded
            $table->string('seen_status'); // Name of the downloaded file
            $table->string('date_for_action'); // Path to the downloaded file
            $table->string('remarks'); // IP address of the user
            $table->string('status'); // Browser details
            $table->timestamps(); // Created at & Updated at

            // Foreign key constraint (if users table exists)
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('downloadhistory');
    }
};
