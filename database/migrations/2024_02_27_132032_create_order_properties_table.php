<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('order_properties', function (Blueprint $table) {
            $table->unsignedBigInteger('order_id');
            $table->string('FIO');
            $table->string('email');
            $table->string('phone');
            $table->string('address');
            $table->text('comment');

            $table->foreign('order_id')->references('id')->on('orders')->cascadeOnDelete();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('order_properties');
    }
};
