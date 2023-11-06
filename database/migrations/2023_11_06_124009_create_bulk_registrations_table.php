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
        Schema::dropIfExists('bulk_registrations');
        Schema::create('bulk_registrations', function (Blueprint $table) {
            $table->uuid('id');
            $table->string('teacher_id');
            $table->string('csv_path');
            $table->enum('status', ['pending', 'processing', 'completed', 'failed']);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('bulk_registrations');
    }
};
