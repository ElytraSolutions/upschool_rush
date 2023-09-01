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
            $table->dropColumn(['content_json', 'html', 'css', 'js']);
            $table->uuid('content');
            $table->foreign('content')->references('id')->on('rich_contents');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
        Schema::table('lessons', function (Blueprint $table) {
            $table->dropForeign(['content']);
            $table->dropColumn(['content']);
            $table->longText('content_json');
            $table->longText('html');
            $table->longText('css');
            $table->longText('js');
        });
    }
};
