<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\RentPostController;


Route::get('/', function () {
    return view('welcome');
});

Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login']);

Route::get('/register', [AuthController::class, 'showRegister']);
Route::post('/register', [AuthController::class, 'register']);


Route::middleware('auth')->group(function () {

    Route::get('/dashboard', function () {
        return 'Logged in';
    });

    Route::post('/logout', [AuthController::class, 'logout']);

    Route::resource('rent-posts', RentPostController::class);
});
