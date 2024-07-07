<?php

use Illuminate\Support\Facades\Route;
use App\Http\Middleware\Status;
use App\Http\Controllers\CourseController;
use App\Http\Controllers\CategoryController;

Route::get('/', function () {
    return view('user/layouts/app');
});

Route::get('/generate-transcript/{videoId}', [CourseController::class, 'generateTranscript']);
Route::get('/generate-summary/{videoId}', [CourseController::class, 'generateSummary']);


Route::middleware(['auth', Status::class])->prefix('/admin')->group(function () {
    Route::get('/dashboard', [App\Http\Controllers\DashboardController::class, 'index'])->name('dashboard');
    Route::resource('category', CategoryController::class);
    Route::resource('course', CourseController::class);
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
