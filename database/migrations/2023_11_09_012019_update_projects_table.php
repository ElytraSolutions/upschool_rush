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
        Schema::table('projects', function (Blueprint $table) {
            $table->text('intro')->after('name')->nullable()->change();
            $table->longText('description')->after('intro')->nullable()->change();
            $table->string('location')->after('description')->nullable();
            $table->string('genre')->after('location')->nullable();
            $table->string('image')->after('genre')->nullable();
            $table->string('thumbnail')->after('image')->nullable();
            $table->json('sustainability_details')->after('thumbnail')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('projects', function (Blueprint $table) {
            $table->text('intro')->after('name')->nullable(false)->change();
            $table->longText('description')->after('intro')->nullable(false)->change();
            $table->dropColumn('location');
            $table->dropColumn('genre');
            $table->dropColumn('image');
            $table->dropColumn('thumbnail');
        });
    }
};
