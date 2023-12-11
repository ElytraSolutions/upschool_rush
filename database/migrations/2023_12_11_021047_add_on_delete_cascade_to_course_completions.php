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
        Schema::table('course_completions', function (Blueprint $table) {
            $table->dropForeign('course_completions_course_id_foreign');
            $table->foreign('course_id')->references('id')->on('courses')->onDelete('cascade')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('course_completions', function (Blueprint $table) {
            $table->dropForeign('course_completions_course_id_foreign');
            $table->foreign('course_id')->references('id')->on('courses');
        });
    }
};
