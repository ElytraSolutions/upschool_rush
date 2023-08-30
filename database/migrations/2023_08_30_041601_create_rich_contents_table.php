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
        Schema::create('rich_contents', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->timestamps();
            $table->longText('html');
            $table->longText('css');
            $table->longText('js');
            $table->longText('project_data');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('rich_contents');
    }
};
