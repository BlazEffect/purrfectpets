<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('reviews', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->integer('status');
            $table->string('name');
            $table->text('text')->nullable();
            $table->integer('rating_value');
            $table->timestamps();

            $table->foreign('user_id', 'fk12_users')->references('id')->on('users');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('reviews');
    }
};
