<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::table('orders_products', function (Blueprint $table) {
            $table->unsignedInteger('count');
            $table->decimal('price', 10);
        });
    }

    public function down(): void
    {
        Schema::table('orders_products', function (Blueprint $table) {
            $table->dropColumn('count');
            $table->dropColumn('price');
        });
    }
};
