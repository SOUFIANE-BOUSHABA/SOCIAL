<?php

use App\Http\Controllers\PostController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\FollowerController;

Route::get('/',[PostController::class, 'home'])->name('frontOffice.home');


Route::get('/home', function () {
    return view('front-office.home');
});


Route::get('/register', [AuthController::class, 'showForm'])->name('register');
Route::post('/registerUser', [AuthController::class, 'store'])->name('registerUser');
Route::get('/login', [AuthController::class, 'index'])->name('login');
Route::post('/login', [AuthController::class, 'login'])->name('login'); 
Route::get('/logout', [AuthController::class, 'logout'])->name('logout');


Route::get('/home',[PostController::class, 'home'])->name('frontOffice.home');
Route::post('/home',[PostController::class,'AddPost'])->name('AddPost');
Route::delete('/home/{id}',[PostController::class,'DeletePost'])->name('DeletePost');

//Route::post('/home/{id}/',[PostController::class ,'TchickLike'])->name('TchickLike');

Route::post('/like/{id}', [PostController::class,'PostLike'])->name('PostLike')->middleware('auth');
Route::get('/like/{id}', [PostController::class,'PostLike'])->name('profile-like')->middleware('auth');


Route::get('/users',[UserController::class, 'show'])->name('frontOffice.users');
Route::get('/SearchUsers/{search}',[UserController::class, 'search'])->name('frontOffice.search');

Route::get('/profil/{id}',[UserController::class, 'showProfile'])->name('profil')->middleware('auth');

Route::get('/home/{id}',[CommentController::class,'index'])->name('Comment');
Route::post('/home/Comment/{id}',[CommentController::class,'AddComment'])->name('AddComment');

Route::delete('/home/{id}/delete',[CommentController::class,'DeleteComment'])->name('DeleteComment');


Route::get('/follow/{userId}', [FollowerController::class, 'follow'])->name('follow.user')->middleware('auth');
Route::get('/followers/{userId}', [FollowerController::class, 'followers'])->name('followers.user')->middleware('auth');