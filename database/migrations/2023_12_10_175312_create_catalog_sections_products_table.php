<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('catalog_sections_products', function (Blueprint $table) {
            $table->unsignedBigInteger('product_id');
            $table->unsignedBigInteger('section_id');

            $table->foreign('product_id', 'fk3_catalog_products')
                ->references('id')
                ->on('catalog_products')
                ->cascadeOnDelete();
            $table->foreign('section_id', 'fk4_catalog_sections')
                ->references('id')
                ->on('catalog_sections')
                ->cascadeOnDelete();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('catalog_sections_products');
    }
};
