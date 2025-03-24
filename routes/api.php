<?php

use App\Http\Controllers\Api\AboutController;
use App\Http\Controllers\Api\ContactController;
use App\Http\Controllers\Api\ServiceController;
use App\Http\Controllers\Api\SchoolHighlightController;
use App\Http\Controllers\Api\SchoolController;
use App\Http\Controllers\Api\StudentController;
use App\Http\Controllers\Api\MemberController;
use Illuminate\Support\Facades\Route;

Route::prefix('v1')->group(function () {
    // 關於我們
    Route::get('about', [AboutController::class, 'index']);
    
    // 聯絡資訊
    Route::get('contact', [ContactController::class, 'index']);
    
    // 服務項目
    Route::get('services', [ServiceController::class, 'index']);
    Route::get('services/{service}', [ServiceController::class, 'show']);
    
    // 合作花絮
    Route::get('highlights', [SchoolHighlightController::class, 'index']);
    Route::get('highlights/{highlight}', [SchoolHighlightController::class, 'show']);
    
    // 合作學校
    Route::get('schools', [SchoolController::class, 'index']);
    Route::get('schools/{school}', [SchoolController::class, 'show']);
    
    // 學生
    Route::get('students', [StudentController::class, 'index']);
    Route::get('students/{student}', [StudentController::class, 'show']);
    
    // 會員
    Route::get('members', [MemberController::class, 'index']);
    Route::get('members/{member}', [MemberController::class, 'show']);
}); 