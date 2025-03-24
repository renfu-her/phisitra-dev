<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('school_highlights', function (Blueprint $table) {
            $table->dropColumn('highlight_date');
        });
    }

    public function down(): void
    {
        Schema::table('school_highlights', function (Blueprint $table) {
            $table->date('highlight_date')->nullable();
        });
    }
}; 