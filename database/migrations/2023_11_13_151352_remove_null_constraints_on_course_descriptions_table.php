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
            $table->string('subtitle')->nullable()->change();
            $table->longText('description')->nullable()->change();
            $table->longText('testimonials')->nullable()->change();
            $table->longText('objectives')->nullable()->change();
            $table->json('steps')->nullable()->change();
            $table->json('faq')->nullable()->change();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('course_descriptions', function (Blueprint $table) {
            $table->string('subtitle')->nullable(false)->change();
            $table->longText('description')->nullable(false)->change();
            $table->longText('testimonials')->nullable(false)->change();
            $table->longText('objectives')->nullable(false)->change();
            $table->json('steps')->nullable(false)->change();
            $table->json('faq')->nullable(false)->change();
        });
    }
};
