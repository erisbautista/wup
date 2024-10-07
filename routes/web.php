<?php

use App\Http\Controllers\Violations\ViolationController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('pages.login');
})->name('login');

Route::get('/home', function () {
    return view('pages.home');
})->name('home');

Route::get('/violation', function () {
    return view('pages.violation');
})->name('violation');

Route::get('/violation/register', function () {
    return view('pages.violations.register');
})->name('violation_register');

Route::get('/violation/record', function () {
    return view('pages.violations.record');
})->name('violation_record');

Route::get('/violation/analysis', [ViolationController::class, 'getViolationAnalysis'])->name('violation_analysis');

Route::get('/violation/recent', function () {
    return view('pages.violations.recent');
})->name('violation_recent');


Route::get('/calendar', function () {
    return view('pages.calendar');
})->name('calendar');

Route::get('/calendar/view', function () {
    return view('pages.calendar.view');
})->name('calendar_view');

Route::get('/calendar/activity', function () {
    return view('pages.calendar.activity');
})->name('calendar_activity');

Route::get('/calendar/feedback', function () {
    return view('pages.calendar.feedback');
})->name('calendar_feedback');

Route::get('ncae', function() {
    return view('pages.ncae');
})->name('ncae');

Route::get('ncae/strand', function() {
    return view('pages.ncae.strand');
})->name('ncae_strand');

Route::get('ncae/career', function() {
    return view('pages.ncae.career');
})->name('ncae_career');

Route::get('ncae/test', function() {
    return view('pages.ncae.test');
})->name('ncae_test');

Route::get('ncae/result', function() {
    return view('pages.ncae.result');
})->name('ncae_result');