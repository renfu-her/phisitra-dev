<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\SchoolController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\StudentController;
use Illuminate\Support\Facades\Route;

Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/about', [HomeController::class, 'about'])->name('about');
Route::get('/contact', [ContactController::class, 'index'])->name('contact.index');
Route::post('/contact', [ContactController::class, 'store'])->name('contact.store');
Route::get('/services', [HomeController::class, 'services'])->name('services');
Route::get('/profile', [ProfileController::class, 'index'])->name('profile');
Route::put('/profile', [ProfileController::class, 'update'])->name('profile.update');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// 登入相關路由
Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login'])->name('login.submit');
Route::post('/register', [AuthController::class, 'register'])->name('register.submit');

Route::prefix('schools')->group(function () {
    Route::get('/', [SchoolController::class, 'index'])->name('schools');
    Route::get('/gallery', [SchoolController::class, 'gallery'])->name('schools.gallery');
    Route::get('/{school}', [SchoolController::class, 'show'])->name('schools.show');
});

Route::get('/students', [StudentController::class, 'index'])->name('students.index');
Route::get('/students/{student}', [StudentController::class, 'show'])->name('students.show');
Route::post('/students/toggle/{student}', [StudentController::class, 'toggleStudent'])->name('students.toggle');