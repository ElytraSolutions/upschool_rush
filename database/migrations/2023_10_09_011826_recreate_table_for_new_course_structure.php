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
        //
        Schema::dropIfExists('chapter_completion');
        Schema::dropIfExists('course_enrollments');
        Schema::dropIfExists('lesson_section_contents');
        Schema::dropIfExists('lesson_sections');
        Schema::dropIfExists('lessons');
        Schema::dropIfExists('chapters');
        Schema::dropIfExists('courses');
        Schema::create('courses', function(Blueprint $table) {
            $table->uuid('id')->primary();
            $table->string('name');
            $table->string('slug');
            $table->text('intro')->nullable();
            $table->text('starredText')->nullable();
            $table->string('image')->nullable();
            $table->string('theme')->nullable();
            $table->foreignUuid('description')->nullable()->constrained('rich_contents')->onDelete('SET NULL');
            $table->boolean('active')->default(true);
            $table->foreignId('course_category_id')->nullable()->constrained('course_categories')->onDelete('SET NULL');
            $table->string('tagline')->nullable();
            $table->string('thumbnail')->nullable();
            $table->timestamps();
        });
        Schema::create('chapters', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->string('name');
            $table->string('slug');
            $table->foreignUuid('course_id')->constrained('courses')->onDelete('CASCADE');
            $table->integer('priority')->default(0);
            $table->boolean('active')->default(true);
            $table->timestamps();
        });
        Schema::create('lessons', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->string('name');
            $table->string('slug');
            $table->foreignUuid('chapter_id')->constrained('chapters')->onDelete('CASCADE');
            $table->integer('priority')->default(0);
            $table->boolean('active')->default(true);
            $table->timestamps();
        });
        Schema::create('lesson_sections', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->string('name');
            $table->string('slug');
            $table->foreignUuid('lesson_id')->constrained('lessons')->onDelete('CASCADE');
            $table->integer('priority')->default(0);
            $table->boolean('active')->default(true);
            $table->timestamps();
        });
        Schema::create('lesson_section_contents', function(Blueprint $table) {
            $table->uuid('id')->primary();
            $table->string('name')->nullable();
            $table->foreignUuid('lesson_section_id')->constrained('lesson_sections')->onDelete('CASCADE');
            $table->enum('type', [
                'video',
                'image',
                'flipbook',
            ]);
            $table->string('content');
            $table->integer('priority')->default(0);
            $table->boolean('active')->default(true);
            $table->timestamps();
        });
        Schema::create('chapter_completions', function(Blueprint $table) {
            $table->foreignUuid('chapter_id')->constrained('chapters')->onDelete('CASCADE');
            $table->foreignUuid('user_id')->constrained('users')->onDelete('CASCADE');
        });
        Schema::create('course_enrollments', function(Blueprint $table) {
            $table->foreignUuid('course_id')->constrained('courses')->onDelete('CASCADE');
            $table->foreignUuid('user_id')->constrained('users')->onDelete('CASCADE');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
        Schema::dropIfExists('chapter_completions');
        Schema::dropIfExists('course_enrollments');
        Schema::dropIfExists('lesson_section_contents');
        Schema::dropIfExists('lesson_sections');
        Schema::dropIfExists('lessons');
        Schema::dropIfExists('chapters');
        Schema::dropIfExists('courses');
    }
};
