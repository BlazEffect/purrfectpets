<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('orders_products', function (Blueprint $table) {
            $table->unsignedBigInteger('order_id');
            $table->unsignedBigInteger('product_id');

            $table->foreign('product_id', 'fk10_catalog_products')
                ->references('id')
                ->on('catalog_products')
                ->cascadeOnDelete();
            $table->foreign('order_id', 'fk11_orders')->references('id')->on('orders')->cascadeOnDelete();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('orders_products');
    }
};
