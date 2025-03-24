<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('school_highlights', function (Blueprint $table) {
            $table->dropForeign(['school_id']);
            $table->dropColumn('school_id');
        });
    }

    public function down(): void
    {
        Schema::table('school_highlights', function (Blueprint $table) {
            $table->foreignId('school_id')->constrained()->cascadeOnDelete();
        });
    }
}; 