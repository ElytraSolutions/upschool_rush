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
        Schema::table('lessons', function (Blueprint $table) {
            $table->dropColumn('content');
            $table->longText('html')->nullable()->before('active');
            $table->longText('css')->nullable()->after('html');
            $table->longText('js')->nullable()->after('css');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
        Schema::table('lessons', function (Blueprint $table) {
            $table->dropColumn('html');
            $table->dropColumn('css');
            $table->dropColumn('js');
            $table->longText('content')->nullable()->after('intro');
        });
    }
};
