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
        Schema::table('courses', function (Blueprint $table) {
            $table->dropColumn('description');
        });
        Schema::table('courses', function (Blueprint $table) {
            $table->uuid('description')->nullable();
            $table->foreign('description')->references('id')->on('rich_contents')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
        Schema::table('courses', function (Blueprint $table) {
            // $table->dropForeign(['description']);
            $table->text('description')->change();
        });
    }
};
