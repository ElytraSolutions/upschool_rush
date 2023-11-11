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
        Schema::table('charities', function (Blueprint $table) {
            $table->uuid('id')->primary()->change();
        });
        Schema::table('projects', function (Blueprint $table) {
            $table->foreignUuid('charity_id')->nullable()->constrained('charities')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('projects', function (Blueprint $table) {
            $table->dropConstrainedForeignId('charity_id');
        });
        Schema::table('charities', function (Blueprint $table) {
            $table->dropPrimary();
        });
    }
};
