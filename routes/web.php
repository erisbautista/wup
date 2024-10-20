<?php

use App\Http\Controllers\Activity\ActivityController;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\Users\UserController;
use App\Http\Controllers\Violations\UserViolationController;
use App\Http\Controllers\Violations\ViolationController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('pages.login');
})->name('login');

Route::post('/login', [LoginController::class, 'authenticate']);
Route::get('/logout', [LoginController::class, 'logout'])->name('logout');

Route::get('/home', function () {
    return view('pages.home');
})->name('home');

// ---------------------------------------------------------------- User CRUD routes ----------------------------------------------------------------
Route::prefix('user')->group(function() {
    Route::get('/create', [UserController::class, 'index'])->name('create_user');
    Route::post('/', [UserController::class, 'createUser']);
    Route::get('/{id}', [UserController::class, 'getUserById']);
    Route::put('/{id}', [UserController::class, 'updateUser'])->name('update_user');
    Route::delete('/{id}', [UserController::class, 'deleteUser'])->name('delete_user');

    Route::prefix('/password')->group(function() {
        Route::get('/{id}', [UserController::class, 'passwordView'])->name('update_password_view');
        Route::put('/{id}', [UserController::class, 'updatePassword'])->name('update_password');
        Route::post('/check', [UserController::class, 'checkPassword'])->name('password_check');
    });
});

// ---------------------------------------------------------------- Violation CRUD routes ----------------------------------------------------------------
Route::prefix('violation')->group(function() {
    Route::get('/', [ViolationController::class, 'index'])->name('create_violation_view');
    Route::post('/', [ViolationController::class, 'createViolation'])->name('create_violation');
    Route::get('/{id}', [ViolationController::class, 'getViolationById'])->name('update_violation_view');
    Route::put('/{id}', [ViolationController::class, 'updateViolation'])->name('update_violation');
    Route::delete('/{id}', [ViolationController::class, 'deleteViolation'])->name('delete_violation');
});

// ---------------------------------------------------------------- Activity CRUD routes ----------------------------------------------------------------
Route::prefix('activity')->group(function() {
    Route::get('/', [ActivityController::class, 'index'])->name('create_activity_view');
    Route::post('/', [ActivityController::class, 'createActivity'])->name('create_activity');
    Route::get('/{id}', [ActivityController::class, 'getActivityById'])->name('update_activity_view');
    Route::put('/{id}', [ActivityController::class, 'updateActivity'])->name('update_activity');
    Route::delete('/{id}', [ActivityController::class, 'deleteActivity'])->name('delete_activity');
});

// ---------------------------------------------------------------- Admin routes ----------------------------------------------------------------
Route::prefix('admin')->group(function () {
    Route::get('/user', [AdminController::class, 'getUsers'])->name('admin_user');
    Route::get('/activity', [AdminController::class, 'getActivities'])->name('admin_activity');
    Route::get('/violation', [AdminController::class, 'getViolations'])->name('admin_violation');
    Route::get('/history', [AdminController::class, 'getHistories'])->name('admin_history');
});

// ---------------------------------------------------------------- Violation routes ----------------------------------------------------------------
Route::prefix('user/violation')->group(function() {
    Route::get('/', function () {
        return view('pages.violation');
    })->name('violation');
    Route::get('/register', function () {
        return view('pages.violations.register');
    })->name('violation_register');
    Route::get('/record', function () {
        return view('pages.violations.record');
    })->name('violation_record');
    Route::get('/analysis', [UserViolationController::class, 'getViolationAnalysis'])->name('violation_analysis');
    Route::get('/recent', function () {
        return view('pages.violations.recent');
    })->name('violation_recent'); 
});

// ---------------------------------------------------------------- Calendar routes ----------------------------------------------------------------
Route::prefix('calendar')->group(function() {
    Route::get('/', function () {
        return view('pages.calendar');
    })->name('calendar');
    
    Route::get('/view', function () {
        return view('pages.calendar.view');
    })->name('calendar_view');
    
    Route::get('/activity', function () {
        return view('pages.calendar.activity');
    })->name('calendar_activity');
    
    Route::get('/feedback', function () {
        return view('pages.calendar.feedback');
    })->name('calendar_feedback');
});

// ---------------------------------------------------------------- ncae routes ----------------------------------------------------------------
Route::prefix('ncae')->group(function() {
    Route::get('/', function() {
        return view('pages.ncae');
    })->name('ncae');
    
    Route::get('/strand', function() {
        return view('pages.ncae.strand');
    })->name('ncae_strand');
    
    Route::get('/career', function() {
        return view('pages.ncae.career');
    })->name('ncae_career');
    
    Route::get('/test', function() {
        return view('pages.ncae.test');
    })->name('ncae_test');
    
    Route::get('/result', function() {
        return view('pages.ncae.result');
    })->name('ncae_result');
});











