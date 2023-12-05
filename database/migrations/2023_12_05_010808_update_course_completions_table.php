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
            $table->boolean('email_sent')->default(false)->after('coursework_path');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('course_completions', function (Blueprint $table) {
            $table->dropColumn('email_sent');
        });
    }
};
