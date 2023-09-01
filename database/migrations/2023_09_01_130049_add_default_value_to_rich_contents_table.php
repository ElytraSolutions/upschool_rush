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
        Schema::table('rich_contents', function (Blueprint $table) {
            //
            $table->longText('html')->nullable()->change();
            $table->longText('css')->nullable()->change();
            $table->longText('js')->nullable()->change();
            $table->longText('project_data')->nullable()->change();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('rich_contents', function (Blueprint $table) {
            //
            $table->longText('html')->change();
            $table->longText('css')->change();
            $table->longText('js')->change();
            $table->longText('project_data')->change();
        });
    }
};
