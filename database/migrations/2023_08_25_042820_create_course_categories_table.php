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
        Schema::create('course_categories', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->string('name');
        });
        Schema::table('courses', function (Blueprint $table) {
            $table->foreignId('course_category_id')->nullable()->constrained('course_categories');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('course_categories');
        Schema::table('courses', function (Blueprint $table) {
            $table->dropConstrainedForeignId('course_category_id');
        });
    }
};
