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
        Schema::create('chapter_completion', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->foreignUuid('user_id')
                ->constrained()
                ->onDelete('cascade');
            $table->foreignId('chapter_id')
                ->constrained()
                ->onDelete('cascade');
            $table->unique(['user_id', 'chapter_id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('chapter_completion');
    }
};
