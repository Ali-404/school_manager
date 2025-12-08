<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/login', function () {
    return view('auth.login');
})->name('login');

Route::get('/student-login', function () {
    return view('auth.student-login');
})->name('student.login');

Route::get('/manager-dashboard', function () {
    return view('manager.dashboard');
})->name('manager.dashboard');

Route::get('/manager-students', function () {
    return view('manager.students');
})->name('manager.students');

Route::get('/manager-modules', function () {
    return view('manager.modules');
})->name('manager.modules');



Route::get('/student-modules', function () {
    return view('student.modules');
})->name('student.modules');


