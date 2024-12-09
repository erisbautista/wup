<?php

use App\Http\Controllers\Activity\ActivityController;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\NCAE\ExamController;
use App\Http\Controllers\NCAE\NCAEController;
use App\Http\Controllers\Users\UserController;
use App\Http\Controllers\Violations\UserViolationController;
use App\Http\Controllers\Violations\ViolationController;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Route;

Route::get('/', [LoginController::class, 'index'])->name('login');
Route::post('/login', [LoginController::class, 'authenticate']);
Route::get('/logout', [LoginController::class, 'logout'])->name('logout');

Route::prefix('password')->group(function() {
    Route::get('/reset', [LoginController::class, 'showLinkRequestForm'])->name('password.request');
    Route::post('/email', [LoginController::class, 'sendResetLinkEmail'])->name('password.email');
    Route::get('/reset/{token}', [LoginController::class, 'showResetForm'])->name('password.reset');
    Route::post('/reset', [LoginController::class, 'resetPassword'])->name('password.update');
});

Route::middleware(['auth'])->group(function() {
    Route::get('/home', function () {
        return view('pages.home');
    })->name('home');

    // ---------------------------------------------------------------- Violation routes ----------------------------------------------------------------
    Route::prefix('user/violation')->group(function() {
        Route::get('/', [UserViolationController::class, 'index'])->name('user_violation');
        Route::get('/register', [UserViolationController::class, 'getRegisterViolationData'])->name('user_violation_register_view');
        Route::post('/register', [UserViolationController::class, 'registerUserViolation'])->name('user_violation_register');
        Route::get('/record', [UserViolationController::class, 'getRecordViolationData'])->name('user_violation_record');
        Route::post('/record', [UserViolationController::class, 'getUserViolationRecord'])->name('user_violation_record_search');
        Route::get('/analysis', [UserViolationController::class, 'getViolationAnalysis'])->name('user_violation_analysis');
        Route::get('/recent', [UserViolationController::class, 'getUserViolations'])->name('user_violation_recent');
        Route::get('/update/{id}', [UserViolationController::class, 'getUserViolationById'])->name('user_violation_update_view');
        Route::put('/update/{id}', [UserViolationController::class, 'updateuserViolation'])->name('user_violation_update');
    });

    // ---------------------------------------------------------------- Calendar routes ----------------------------------------------------------------
    Route::prefix('calendar')->group(function() {
        Route::get('/', [ActivityController::class, 'getUserActivity'])->name('calendar');
        Route::get('/view', [ActivityController::class, 'getActivities'])->name('calendar_view');
        Route::get('/feedback', function () {
            return view('pages.calendar.feedback');
        })->name('calendar_feedback');
        Route::get('/activity', [ActivityController::class, 'createActivityPage'])->name('calendar_activity');
        Route::post('/activity', [ActivityController::class, 'createActivity'])->name('calendar_activity_create');
    });

    // ---------------------------------------------------------------- ncae routes ----------------------------------------------------------------
    Route::prefix('ncae')->group(function() {
        Route::get('/', [NCAEController::class, 'index'])->name('ncae');
        Route::get('/strand', [NCAEController::class, 'strands'])->name('ncae_strand');
        Route::get('/career', [NCAEController::class, 'career'])->name('ncae_career');
        Route::get('/test', [NCAEController::class, 'NCAETest'])->name('ncae_test');
        Route::post('/test', [NCAEController::class, 'submitTest'])->name('ncae_test_submit');
        Route::get('/result', [NCAEController::class, 'result'])->name('ncae_result');
    });
});


Route::middleware(['auth', 'admin'])->group(function () {
    /* ---------------------------------------------------------------- User CRUD routes ---------------------------------------------------------------- */
    Route::prefix('user')->group(function() {
        Route::get('/create', [UserController::class, 'index'])->name('create_user');
        Route::post('/', [UserController::class, 'createUser']);
        Route::get('/{id}', [UserController::class, 'getUserById']);
        Route::put('/{id}', [UserController::class, 'updateUser'])->name('update_user');
        Route::delete('/{id}', [UserController::class, 'deleteUser'])->name('delete_user');
        Route::post('username/check', [UserController::class, 'checkUsername'])->name('check_username');

        Route::prefix('/password')->group(function() {
            Route::get('/{id}', [UserController::class, 'passwordView'])->name('update_password_view');
            Route::put('/{id}', [UserController::class, 'updatePassword'])->name('update_password');
            Route::post('/check', [UserController::class, 'checkPassword'])->name('password_check');
        });
    });

    /* ---------------------------------------------------------------- Violation CRUD routes ---------------------------------------------------------------- */
    Route::prefix('violation')->group(function() {
        Route::get('/', [ViolationController::class, 'index'])->name('create_violation_view');
        Route::post('/', [ViolationController::class, 'createViolation'])->name('create_violation');
        Route::get('/{id}', [ViolationController::class, 'getViolationById'])->name('update_violation_view');
        Route::put('/{id}', [ViolationController::class, 'updateViolation'])->name('update_violation');
        Route::delete('/{id}', [ViolationController::class, 'deleteViolation'])->name('delete_violation');
    });

    /* ---------------------------------------------------------------- Activity CRUD routes ---------------------------------------------------------------- */
    Route::prefix('activity')->group(function() {
        Route::get('/', [ActivityController::class, 'index'])->name('create_activity_view');
        Route::post('/', [ActivityController::class, 'createActivity'])->name('create_activity');
        Route::get('/{id}', [ActivityController::class, 'getActivityById'])->name('update_activity_view');
        Route::put('/{id}', [ActivityController::class, 'updateActivity'])->name('update_activity');
        Route::delete('/{id}', [ActivityController::class, 'deleteActivity'])->name('delete_activity');
    });

    Route::prefix('exam')->group(function() {
        Route::get('/preview/{id}', [ExamController::class, 'previewExam'])->name('preview_exam');
        Route::get('/', [ExamController::class, 'index'])->name('exam');
        Route::post('/', [ExamController::class, 'createExam'])->name('create_exam');
        Route::get('/{id}', [ExamController::class, 'getExamById'])->name('get_exam');
        Route::put('/{id}', [ExamController::class, 'updateExam'])->name('update_exam');
        Route::delete('/{id}', [ExamController::class, 'deleteExam'])->name('delete_exam');

        //Questions routes
        Route::get('/{id}/question', [ExamController::class, 'questionIndex'])->name('question');
        Route::post('/{id}/question', [ExamController::class, 'createQuestion'])->name('create_question');
        Route::put('/question/{id}', [ExamController::class, 'updateQuestion'])->name('update_question');
        Route::get('/question/{id}', [ExamController::class, 'getQuestionById'])->name('get_question');
        Route::delete('/question/{id}', [ExamController::class, 'deleteQuestion'])->name('delete_question');

        //Choices routes
        Route::post('/choices', [ExamController::class, 'createChoices'])->name('create_choices');
        Route::get('/choice/{id}', [ExamController::class, 'getChoiceById'])->name('get_choice');
        Route::put('/choices/{id}', [ExamController::class, 'updateChoices'])->name('update_choices');
        Route::delete('/choices/{id}', [ExamController::class, 'deleteChoices'])->name('delete_choices');
    });

    /* ---------------------------------------------------------------- Admin routes ---------------------------------------------------------------- */
    Route::prefix('admin')->group(function () {
        Route::get('/user', [AdminController::class, 'getUsers'])->name('admin_user');
        Route::get('/activity', [AdminController::class, 'getActivities'])->name('admin_activity');
        Route::get('/violation', [AdminController::class, 'getViolations'])->name('admin_violation');
        Route::get('/history', [AdminController::class, 'getHistories'])->name('admin_history');
        Route::get('/exam', [AdminController::class, 'getExams'])->name('admin_exam');
    });
});








