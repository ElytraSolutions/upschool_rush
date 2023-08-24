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
        Schema::create('books', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->string("title");
            $table->string('slug')->unique();
            $table->longText('description');
            $table->string('teacher_email')->nullable();
            $table->string('first_name');
            $table->string('last_name');
            $table->string('school_name')->nullable();
            $table->string('country');
            $table->integer('age');
            $table->string('path')->nullable();
            $table->string('canva_link')->nullable();
            $table->boolean('active');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('books');
    }
};
