<?php

use App\Http\Controllers\Api\CourseContoller;
use App\Http\Controllers\Api\LessonController;
use App\Http\Controllers\Api\ModuleController;
use Illuminate\Support\Facades\Route;

Route::get('/courses', [CourseContoller::class, 'index'])->name('course.index');
Route::post('/courses', [CourseContoller::class, 'store'])->name('course.store');
Route::get('/courses/{identify}', [CourseContoller::class, 'show'])->name('course.show');
Route::delete('/courses/{identify}', [CourseContoller::class, 'destroy'])->name('course.destroy');
Route::put('/courses/{course}', [CourseContoller::class, 'update'])->name('course.update');

Route::apiResource('/courses/{course}/modules', ModuleController::class);
Route::apiResource('/modules/{module}/lessons', LessonController::class);

Route::get('/', function() {
    return response()->json(['message' => 'ok']);
});
