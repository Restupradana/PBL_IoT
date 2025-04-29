<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;



Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});


// use App\Http\Controllers\AuthController;
// use App\Http\Controllers\ForgotPasswordController;

// // Login & Register
// Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
// Route::post('/login', [AuthController::class, 'login']);

// Route::get('/register', [AuthController::class, 'showRegisterForm'])->name('register');
// Route::post('/register', [AuthController::class, 'register']);

// Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// // Lupa Password
// Route::get('/forgot-password', [ForgotPasswordController::class, 'showLinkRequestForm'])->name('password.request');
// Route::post('/forgot-password', [ForgotPasswordController::class, 'sendResetLinkEmail'])->name('password.email');

Route::get('/', function () {
    return view('welcome');
});

Route::get('/user/index', function () {
    return view('user.index');
});
Route::get('/user/dashboard', function () {
    return view('user.dashboard');
})->name('user.dashboard');

Route::get('/user/status', function () {
    return view('user.status');
})->name('user.status');

Route::get('/user/location', function () {
    return view('user.location');
})->name('user.location');

Route::get('/user/history', function () {
    return view('user.history');
})->name('user.history');

#logout
Route::post('/logout', function () {
    // Logika logout di sini
    return redirect('/');
})->name('logout');

require __DIR__.'/auth.php';
