<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\LessonController;
use App\Http\Controllers\AssignmentController;
use App\Http\Controllers\AssignmentSubmissionController;
use App\Http\Controllers\AttendanceController;
use App\Http\Controllers\StudentAttendanceReportController;
use App\Http\Controllers\FileDownloadController;

// File download (public route, authenticated)
Route::middleware('auth')->group(function () {
    Route::get('/files/download/{type}/{filename}', [FileDownloadController::class, 'download'])
        ->name('files.download')->whereIn('type', ['lessons', 'assignments', 'submissions']);
});

// Guest routes
Route::middleware('guest')->group(function () {
    Route::get('/', function () {
        return redirect()->route('login');
    });
    Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
    Route::post('/login', [AuthController::class, 'login']);
    Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
    Route::post('/register', [AuthController::class, 'register']);
});

// Authenticated routes
Route::middleware('auth')->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

    // Lessons - accessible by both guru and siswa
    Route::resource('lessons', LessonController::class);

    // Assignments - accessible by both guru and siswa
    Route::resource('assignments', AssignmentController::class);

    // Assignment Submissions - for siswa
    Route::post('/assignments/{assignment}/submit', [AssignmentSubmissionController::class, 'submit'])
        ->name('assignments.submit')->middleware('role:siswa');

    // Grading - for guru only
    Route::post('/submissions/{submission}/grade', [AssignmentSubmissionController::class, 'grade'])
        ->name('submissions.grade')->middleware('role:guru');

    // Attendances
    Route::resource('attendances', AttendanceController::class);
    Route::get('/attendances-report', [AttendanceController::class, 'report'])
        ->name('attendances.report')->middleware('role:guru');
    
    // Student Attendance Report - for guru only
    Route::get('/student-attendance-report', [StudentAttendanceReportController::class, 'index'])
        ->name('student.attendance.report')->middleware('role:guru');
});


