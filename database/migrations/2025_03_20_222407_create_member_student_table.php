<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('member_student', function (Blueprint $table) {
            $table->id();
            $table->foreignId('member_id')->constrained()->onDelete('cascade');
            $table->foreignId('student_id')->constrained()->onDelete('cascade');
            $table->timestamps();

            // 確保一個學生只會被同一個會員選擇一次
            $table->unique(['member_id', 'student_id']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('member_student');
    }
}; 