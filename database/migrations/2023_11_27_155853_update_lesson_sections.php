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
        Schema::table('lesson_sections', function (Blueprint $table) {
            $table->boolean('downloadable')->default(false)->after('active');
            $table->string('canva_template')->nullable()->after('downloadable');
            $table->boolean('share_with_upschool')->default(false)->after('canva_template');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('lesson_sections', function (Blueprint $table) {
            $table->dropColumn('downloadable');
            $table->dropColumn('canva_template');
            $table->dropColumn('share_with_upschool');
        });
    }
};
