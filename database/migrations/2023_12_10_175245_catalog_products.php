<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('catalog_products', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('slug');
            $table->text('description')->nullable();
            $table->unsignedBigInteger('brand_id')->nullable();
            $table->string('image')->nullable();
            $table->decimal('price', 10);
            $table->bigInteger('quantity')->default(0);
            $table->boolean('active')->default(false);
            $table->unsignedBigInteger('order')->default(0);
            $table->timestamps();

            $table->foreign('brand_id', 'fk2_brands')->references('id')->on('brands')->restrictOnDelete();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('catalog_products');
    }
};
