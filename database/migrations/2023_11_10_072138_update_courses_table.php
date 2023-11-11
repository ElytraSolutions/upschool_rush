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
        Schema::table('courses', function (Blueprint $table) {
            $table->dropConstrainedForeignId('description');
        });
        Schema::table('courses', function (Blueprint $table) {
            $table->foreignUuid('description')->nullable()->constrained('course_descriptions')->after('intro');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('courses', function (Blueprint $table) {
            $table->dropConstrainedForeignId('description');
        });
        Schema::table('courses', function (Blueprint $table) {
            $table->foreignUuid('description')->nullable()->constrained('rich_contents')->after('intro');
        });
    }
};
