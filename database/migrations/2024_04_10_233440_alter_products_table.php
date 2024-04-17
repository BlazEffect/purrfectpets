<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::table('catalog_products', function (Blueprint $table) {
            $table->unsignedInteger('quantity')->default(0)->change();
        });
    }

    public function down(): void
    {
        Schema::table('catalog_products', function (Blueprint $table) {
            $table->bigInteger('quantity')->default(0)->change();
        });
    }
};
