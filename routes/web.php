<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

// auth
Route::middleware("auth")->get("/user", function () {
    return Auth()->user();
});
