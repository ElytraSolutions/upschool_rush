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
        Schema::table('bulk_registrations', function (Blueprint $table) {
            $table->uuid('id')->primary()->change();
            $table->text('data')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('bulk_registrations', function (Blueprint $table) {
            $table->dropColumn('data');
        });
    }
};
