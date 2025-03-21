<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('school_highlights', function (Blueprint $table) {
            $table->id();
            $table->foreignId('school_id')->constrained()->cascadeOnDelete();
            $table->string('title');       // 花絮標題
            $table->text('description')->nullable(); // 花絮描述
            $table->string('media_type'); // 媒體類型（image/video）
            $table->string('media_path'); // 媒體檔案路徑
            $table->date('highlight_date'); // 花絮日期
            $table->integer('sort_order')->default(0); // 排序
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('school_highlights');
    }
}; 