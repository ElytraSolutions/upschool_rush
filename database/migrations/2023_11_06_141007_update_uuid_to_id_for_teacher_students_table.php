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
        Schema::table('teacher_students', function (Blueprint $table) {
            $table->dropColumn('uuid');
            $table->uuid('id')->primary()->first();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('teacher_students', function (Blueprint $table) {
            $table->dropColumn('id');
            $table->uuid('uuid')->primary()->first();
        });
    }
};
