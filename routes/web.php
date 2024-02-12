<?php

use App\Http\Controllers\PostController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\UserController;

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
Route::get('/logout', [AuthController::class, 'logout'])->name('logout');


Route::get('/home',[PostController::class, 'home'])->name('frontOffice.home');

Route::get('/users',[UserController::class, 'show'])->name('frontOffice.users');
Route::get('/SearchUsers/{search}',[UserController::class, 'search'])->name('frontOffice.search');

Route::get('/profil',[UserController::class, 'profil'])->name('profil');