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
        Schema::table('downloadhistory', function (Blueprint $table) {
            //
            $table->unsignedBigInteger('upload_id')->after('id'); // Add upload_id column
            $table->foreign('upload_id')->references('id')->on('uploadmasters')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('downloadhistory', function (Blueprint $table) {
            //
        });
    }
};
