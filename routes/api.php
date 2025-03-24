<?php

use App\Http\Controllers\Api\AboutController;
use App\Http\Controllers\Api\ContactController;
use App\Http\Controllers\Api\ServiceController;
use App\Http\Controllers\Api\SchoolHighlightController;
use App\Http\Controllers\Api\SchoolController;
use App\Http\Controllers\Api\StudentController;
use App\Http\Controllers\Api\MemberController;
use Illuminate\Support\Facades\Route;

Route::prefix('v1')->name('api.v1.')->group(function () {
    // 關於我們
    Route::get('about', [AboutController::class, 'index'])->name('about');
    
    // 聯絡資訊
    Route::get('contact', [ContactController::class, 'index'])->name('contact');
    
    // 服務項目
    Route::get('services', [ServiceController::class, 'index'])->name('services');
    Route::get('services/{service}', [ServiceController::class, 'show'])->name('services.show');
    
    // 合作花絮
    Route::get('highlights', [SchoolHighlightController::class, 'index'])->name('highlights');
    Route::get('highlights/{highlight}', [SchoolHighlightController::class, 'show'])->name('highlights.show');
    
    // 合作學校
    Route::get('schools', [SchoolController::class, 'index'])->name('schools');
    Route::get('schools/{school}', [SchoolController::class, 'show'])->name('schools.show');
    
    // 學生
    Route::get('students', [StudentController::class, 'index'])->name('students');
    Route::get('students/{student}', [StudentController::class, 'show'])->name('students.show');
    
    // 會員
    Route::get('members', [MemberController::class, 'index'])->name('members');
    Route::get('members/{member}', [MemberController::class, 'show'])->name('members.show');
}); 