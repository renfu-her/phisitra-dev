<?php

use App\Http\Controllers\Api\AboutController;
use App\Http\Controllers\Api\ContactController;
use App\Http\Controllers\Api\ServiceController;
use App\Http\Controllers\Api\SchoolHighlightController;
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
}); 