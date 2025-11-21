<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

// auth
Route::middleware("auth")->get("/user", function () {
    return Auth()->user();
});
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

Route::post('/student-login', function () {
    return '  login !';
});

