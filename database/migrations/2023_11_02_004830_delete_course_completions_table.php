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
        Schema::dropIfExists('course_completions');
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::create('course_completions', function (Blueprint $table) {
            $table->uuid();
            $table->timestamps();
            $table->foreignUuid('user_id')->constrained('users');
            $table->foreignUuid('course_id')->constrained('courses');
        });
    }
};
