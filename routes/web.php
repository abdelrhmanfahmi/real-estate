<?php

use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Route;


Route::get('/' , function(){
    return redirect()->route('login');
});

Route::get('/login' , [AuthController::class , 'showLoginForm'])->name('login');
Route::post('/login-submit' , [AuthController::class , 'login'])->name('login.submit');

Route::group(['middleware' => 'auth'], function () {
    Route::get('/home' , [HomeController::class , 'home'])->name('home');
    Route::get('/logout' , [AuthController::class , 'logout'])->name('logout');
});
