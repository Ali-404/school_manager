<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\ModuleController;
use App\Http\Controllers\AttachmentController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

Route::get('/', function () {
    return redirect()->route('login');
});

// Common-typo redirects: guide to student pages (preserve intent for signed-in students)
Route::get('/students/module', function () {
    if (Auth::check() && Auth::user()->role === 'student') {
        return redirect()->route('student.modules');
    }
    return redirect()->route('student.login');
});

Route::get('/students/modules', function () {
    if (Auth::check() && Auth::user()->role === 'student') {
        return redirect()->route('student.modules');
    }
    return redirect()->route('student.login');
});

Route::get('/student/module', function () {
    if (Auth::check() && Auth::user()->role === 'student') {
        return redirect()->route('student.modules');
    }
    return redirect()->route('student.login');
});

// Login pages and auth POSTs (only for guests)
Route::middleware('guest')->group(function () {
    Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
    Route::post('/login', [AuthController::class, 'login']);

    Route::get('/student-login', [AuthController::class, 'showStudentLogin'])->name('student.login');
    Route::post('/student-login', [AuthController::class, 'loginStudent']);

    Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
    Route::post('/register', [AuthController::class, 'register']);
});

// Manager routes (protected)
Route::prefix('manager')->middleware(['auth', 'role:manager'])->group(function () {
    Route::get('/dashboard', [\App\Http\Controllers\DashboardController::class, 'index'])->name('manager.dashboard');

    // Student CRUD
    Route::get('/students', [StudentController::class, 'index'])->name('manager.students');
    Route::post('/students', [StudentController::class, 'store'])->name('students.store');
    Route::put('/students/{student}', [StudentController::class, 'update'])->name('students.update');
    Route::delete('/students/{student}', [StudentController::class, 'destroy'])->name('students.destroy');

    // Modules CRUD
    Route::get('/modules', [ModuleController::class, 'index'])->name('manager.modules');
    Route::post('/modules', [ModuleController::class, 'store'])->name('modules.store');
    Route::put('/modules/{module}', [ModuleController::class, 'update'])->name('modules.update');
    Route::delete('/modules/{module}', [ModuleController::class, 'destroy'])->name('modules.destroy');

    // Attachments CRUD (nested under modules)
    Route::get('modules/{module}/attachments', [AttachmentController::class, 'index'])
        ->name('manager.modules.attachments.index');

    Route::post('modules/{module}/attachments', [AttachmentController::class, 'store'])
        ->name('manager.modules.attachments.store');

    Route::delete('modules/{module}/attachments/{attachment}', [AttachmentController::class, 'destroy'])
        ->name('manager.modules.attachments.destroy');

    Route::get('modules/{module}/attachments/{attachment}/download', [AttachmentController::class, 'download'])
        ->name('manager.modules.attachments.download');

    // Manager change password
    Route::put('/password', [\App\Http\Controllers\AuthController::class, 'updatePassword'])->name('manager.password.update');
});

// Student routes (protected)
Route::prefix('student')->middleware(['auth', 'role:student'])->group(function () {
    Route::get('/modules', [ModuleController::class, 'studentIndex'])->name('student.modules');
    Route::get('/modules/{module}/attachments', [AttachmentController::class, 'studentIndex'])->name('student.modules.attachments');
    Route::get('/modules/{module}/attachments/{attachment}/download', [AttachmentController::class, 'download'])->name('student.modules.attachments.download');
});


// Logout (only for authenticated users)
Route::post('/logout', [AuthController::class, 'logout'])->middleware('auth')->name('logout');
