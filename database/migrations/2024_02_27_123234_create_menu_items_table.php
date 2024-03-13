<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('menu_items', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('menu_type_id');
            $table->string('name');
            $table->unsignedBigInteger('parent_id')->nullable();
            $table->boolean('active')->default(false);
            $table->bigInteger('order')->default(0);
            $table->string('icon')->nullable();
            $table->string('url')->nullable();

            $table->foreign('menu_type_id')
                ->references('id')
                ->on('menu_types')
                ->cascadeOnDelete();

            $table->foreign('parent_id')
                ->references('id')
                ->on('menu_items')
                ->cascadeOnDelete();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('menu_items');
    }
};
