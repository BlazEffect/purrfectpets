<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('user_profile', function (Blueprint $table) {
            $table->unsignedBigInteger('user_id');
            $table->string('first_name', 100);
            $table->string('middle_name', 100);
            $table->string('last_name', 100)->nullable();
            $table->string('phone', 18)->nullable();
            $table->string('avatar')->nullable();

            $table->foreign('user_id')->references('id')->on('users')->cascadeOnDelete();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('user_profile');
    }
};
