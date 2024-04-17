<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('catalog_product_properties_values', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('property_id');
            $table->unsignedBigInteger('product_id');
            $table->text('value');
            $table->timestamps();

            $table->foreign('property_id', 'fk7_catalog_product_properties')
                ->references('id')
                ->on('catalog_product_properties')
                ->cascadeOnDelete();
            $table->foreign('product_id', 'fk8_catalog_products')
                ->references('id')
                ->on('catalog_products')
                ->cascadeOnDelete();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('catalog_product_properties_values');
    }
};
