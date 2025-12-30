<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\RentPostController;
use App\Http\Controllers\AdminRentPostController;
use App\Http\Controllers\PublicRentPostController;
use App\Http\Middleware\IsAdmin;

// 1. Authentication (Giữ nguyên)
Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
Route::post('/register', [AuthController::class, 'register']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout')->middleware('auth');

// 2. User Routes (Đưa lên trên các route có tham số {id})
Route::middleware(['auth'])->group(function () {
    Route::resource('rent-posts', RentPostController::class);
});

// 3. Admin Routes (Giữ nguyên)
Route::middleware(['auth', IsAdmin::class])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/rent-posts', [AdminRentPostController::class, 'index'])->name('rent-posts.index');
    Route::post('/rent-posts/{id}/approve', [AdminRentPostController::class, 'approve'])->name('rent-posts.approve');
    Route::post('/rent-posts/{id}/reject', [AdminRentPostController::class, 'reject'])->name('rent-posts.reject');
    Route::delete('/rent-posts/{id}', [AdminRentPostController::class, 'destroy'])->name('rent-posts.destroy');
});

// 4. Public Routes (LUÔN ĐỂ DƯỚI CÙNG)
Route::get('/', [PublicRentPostController::class, 'index'])->name('home');
// Chuyển dòng này xuống cuối cùng để tránh tranh chấp với các route khác
Route::get('/rent-posts/{id}', [PublicRentPostController::class, 'show'])->name('public.rent-posts.show');
