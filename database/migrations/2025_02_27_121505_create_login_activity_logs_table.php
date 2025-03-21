<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up() {
        Schema::create('login_activity_logs', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id')->nullable();
            $table->string('email')->nullable();
            $table->string('ip_address');
            $table->text('user_agent');
            $table->string('status'); // success, failed
            $table->timestamps();
        });
    }

    public function down() {
        Schema::dropIfExists('login_activity_logs');
    }
};
