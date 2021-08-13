<?php

use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

Route::get('/', function () {
    // return view('welcome');
    return Inertia::render('Welcome');
});

Route::get('/user',[UserController::class,'index'])->name('user.index');

Route::delete('/user/{id}',[UserController::class,'destroy']);

Route::get('/user/create',[UserController::class,'create']);

Route::post('/user/store',[UserController::class,'store']);

Route::get('/user/{id}/edit',[UserController:: class,'edit']);

Route::put('/user/{id}/update',[UserController::class,'update']);

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
