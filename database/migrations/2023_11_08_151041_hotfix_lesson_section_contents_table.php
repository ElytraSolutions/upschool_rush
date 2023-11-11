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
        Schema::table('lesson_section_contents', function (Blueprint $table) {
            $table->string('image_content')->after('content')->nullable();
            $table->string('video_content')->after('image_content')->nullable();
            $table->string('flipbook_content')->after('video_content')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('lesson_section_contents', function (Blueprint $table) {
            $table->dropColumn('image_content');
            $table->dropColumn('video_content');
            $table->dropColumn('flipbook_content');
        });
    }
};
