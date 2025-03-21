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
        Schema::create('students', function (Blueprint $table) {
            $table->id();
            $table->string('photo')->nullable();
            $table->string('name_zh')->nullable();
            $table->string('name_en');
            $table->string('gender');
            $table->date('birth_date');
            $table->string('nationality');
            $table->string('passport_no');
            $table->text('overseas_address');
            $table->string('school_name');
            $table->string('department');
            $table->date('enrollment_date');
            $table->integer('study_duration');
            $table->date('expected_graduation_date');
            $table->text('specialties')->nullable();
            $table->text('remarks')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('students');
    }
};
