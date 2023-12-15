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
        Schema::dropIfExists('course_author');
        Schema::create('course_author', function (Blueprint $table) {
            $table->foreignUuid('course_id')->constrained()->onDelete('cascade');
            $table->foreignUuid('user_id')->constrained()->onDelete('cascade');
        });
        // Schema::create('chapter_author', function (Blueprint $table) {
        //     $table->foreignId('chapter_id')->constrained()->onDelete('cascade');
        //     $table->foreignId('author_id')->constrained()->onDelete('cascade');
        // });
        // Schema::create('lesson_author', function (Blueprint $table) {
        //     $table->foreignId('lesson_id')->constrained()->onDelete('cascade');
        //     $table->foreignId('author_id')->constrained()->onDelete('cascade');
        // });
        // Schema::create('lesson_section_author', function (Blueprint $table) {
        //     $table->foreignId('lesson_section_id')->constrained()->onDelete('cascade');
        //     $table->foreignId('author_id')->constrained()->onDelete('cascade');
        // });
        // Schema::create('lesson_section_content_author', function (Blueprint $table) {
        //     $table->foreignId('lesson_section_content_id')->constrained()->onDelete('cascade');
        //     $table->foreignId('author_id')->constrained()->onDelete('cascade');
        // });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('course_author');
        // Schema::dropIfExists('chapter_author');
        // Schema::dropIfExists('lesson_author');
        // Schema::dropIfExists('lesson_section_author');
        // Schema::dropIfExists('lesson_section_content_author');
    }
};
