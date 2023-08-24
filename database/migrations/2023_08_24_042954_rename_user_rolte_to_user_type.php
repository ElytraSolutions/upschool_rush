<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::rename('user_roles', 'user_types');
        Schema::table('users', function (Blueprint $table) {
            //
            $table->renameColumn('user_role_id', 'user_type_id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::rename('user_types', 'user_roles');
        Schema::table('users', function (Blueprint $table) {
            //
            $table->renameColumn('user_type_id', 'user_role_id');
        });
    }
};
