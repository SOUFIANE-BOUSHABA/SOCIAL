<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;



Route::get('/', function () {
    return view('front-office.home');
});

Route::get('/home', function () {
    return view('front-office.home');
});


Route::get('/register', [AuthController::class, 'showForm'])->name('register');
Route::post('/registerUser', [AuthController::class, 'store'])->name('registerUser');
Route::get('/login', [AuthController::class, 'index'])->name('login');
Route::post('/login', [AuthController::class, 'login'])->name('login'); 
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');