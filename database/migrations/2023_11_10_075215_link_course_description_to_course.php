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
        Schema::table('course_descriptions', function (Blueprint $table) {
            $table->foreignUuid('course_id')->constrained();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('course_descriptions', function (Blueprint $table) {
            $table->dropConstrainedForeignId('course_id');
        });
    }
};
