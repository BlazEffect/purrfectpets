<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::rename('orders_products', 'order_products');
    }

    public function down(): void
    {
        Schema::rename('order_products', 'orders_products');
    }
};
