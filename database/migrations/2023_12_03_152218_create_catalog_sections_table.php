<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('catalog_sections', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('slug');
            $table->unsignedBigInteger('parent_id')->nullable();
            $table->text('description')->nullable();
            $table->string('image')->nullable();
            $table->boolean('active')->default(false);
            $table->unsignedBigInteger('order')->default(0);
            $table->timestamps();

            $table->foreign('parent_id', 'fk1_catalog_sections')
                ->references('id')
                ->on('catalog_sections')
                ->cascadeOnDelete();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('catalog_sections');
    }
};
