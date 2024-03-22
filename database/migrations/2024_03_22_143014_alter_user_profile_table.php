<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::rename('user_profile', 'user_profiles');

        Schema::table('user_profiles', function (Blueprint $table) {
            $table->dropColumn('avatar');
            $table->renameColumn('middle_name', 'surname');
        });
    }

    public function down(): void
    {
        Schema::table('user_profiles', function (Blueprint $table) {
            $table->string('avatar')->nullable();
            $table->renameColumn('surname', 'middle_name');
        });

        Schema::rename('user_profiles', 'user_profile');
    }
};
