<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\AuthenticatedSessionController;

// Route umum
Route::get('/', function () {
    return view('welcome');
});

// Dashboard umum
Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // Logout pakai controller resmi Laravel Breeze / Fortify
    Route::post('/logout', [AuthenticatedSessionController::class, 'destroy'])->name('logout');
});

// Group route berdasarkan role dengan middleware custom 'role:admin' misalnya
Route::middleware(['auth', 'role:admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/dashboard', fn() => view('admin.dashboard'))->name('dashboard');
    Route::get('/status', fn() => view('admin.status'))->name('status');
    Route::get('/location', fn() => view('admin.location'))->name('location');
    Route::get('/history', fn() => view('admin.history'))->name('history');
});

Route::middleware(['auth', 'role:user'])->prefix('user')->name('user.')->group(function () {
    Route::get('/dashboard', fn() => view('user.dashboard'))->name('dashboard');
    Route::get('/status', fn() => view('user.status'))->name('status');
    Route::get('/location', fn() => view('user.location'))->name('location');
    Route::get('/history', fn() => view('user.history'))->name('history');
});

Route::middleware(['auth', 'role:janitor'])->prefix('janitor')->name('janitor.')->group(function () {
    Route::get('/dashboard', fn() => view('janitor.dashboard'))->name('dashboard');
    Route::get('/status', fn() => view('janitor.status'))->name('status');
    Route::get('/location', fn() => view('janitor.location'))->name('location');
    Route::get('/history', fn() => view('janitor.history'))->name('history');
});

Route::post('/notifikasi/kirim', [\App\Http\Controllers\NotifikasiController::class, 'kirim'])->name('notifikasi.kirim');


require __DIR__.'/auth.php';
