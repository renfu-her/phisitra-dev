<?php

use App\Http\Controllers\Api\AboutController;
use App\Http\Controllers\Api\ContactController;
use App\Http\Controllers\Api\ServiceController;
use App\Http\Controllers\Api\SchoolHighlightController;
use App\Http\Controllers\Api\SchoolController;
use App\Http\Controllers\Api\StudentController;
use App\Http\Controllers\Api\MemberController;
use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\HomeServiceController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

// 認證路由
Route::prefix('auth')->group(function () {
    Route::post('login', [AuthController::class, 'login']);
    Route::post('logout', [AuthController::class, 'logout']);
});

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


    // 會員
    Route::get('members', [MemberController::class, 'index'])->name('members');
    Route::get('members/{member}', [MemberController::class, 'show'])->name('members.show');

    // Home Services
    Route::get('/home-services', [HomeServiceController::class, 'index']);
    Route::get('/home-services/{id}', [HomeServiceController::class, 'show']);

    // 需要會員認證的路由
    // Route::middleware('auth:member')->group(function () {
    // 學生相關功能
    Route::get('students', [StudentController::class, 'index'])->name('students');

    Route::get('/students/selected', [StudentController::class, 'getSelectedStudents'])->name('students.selected');
    Route::post('/students/{student}/toggle', [StudentController::class, 'toggleStudent'])->name('students.toggle');
    // 學生公開資料
    Route::get('students/{student}', [StudentController::class, 'show'])->name('students.show');

    // });
});
