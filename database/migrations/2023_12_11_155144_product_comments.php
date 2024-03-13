<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('product_comments', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('product_id');
            $table->unsignedBigInteger('user_id');
            $table->integer('status');
            $table->string('name');
            $table->text('advantages')->nullable();
            $table->text('disadvantages')->nullable();
            $table->text('text')->nullable();
            $table->integer('rating_value');
            $table->timestamps();

            $table->foreign('product_id', 'fk5_catalog_products')
                ->references('id')
                ->on('catalog_products')
                ->cascadeOnDelete();
            $table->foreign('user_id', 'fk6_users')->references('id')->on('users');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('product_comments');
    }
};
