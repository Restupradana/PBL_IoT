<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\TrashBinController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\NotificationController;
use App\Http\Controllers\PasswordController;
use App\Http\Controllers\TempatSampahController;
use App\Http\Controllers\RiwayatPembuanganController;
use App\Http\Controllers\ProfileController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

// Guest routes
Route::get('/', function () {
    return view('welcome');
})->name('home');

// Authentication Routes
Route::middleware('guest')->group(function () {
    Route::get('login', [\App\Http\Controllers\Auth\AuthenticatedSessionController::class, 'create'])
        ->name('login');
    Route::post('login', [\App\Http\Controllers\Auth\AuthenticatedSessionController::class, 'store']);
    
    Route::get('register', [\App\Http\Controllers\Auth\RegisteredUserController::class, 'create'])
        ->name('register');
    Route::post('register', [\App\Http\Controllers\Auth\RegisteredUserController::class, 'store']);
    
    Route::get('forgot-password', [\App\Http\Controllers\Auth\PasswordResetLinkController::class, 'create'])
        ->name('password.request');
    Route::post('forgot-password', [\App\Http\Controllers\Auth\PasswordResetLinkController::class, 'store'])
        ->name('password.email');
    
    Route::get('reset-password/{token}', [\App\Http\Controllers\Auth\NewPasswordController::class, 'create'])
        ->name('password.reset');
    Route::post('reset-password', [\App\Http\Controllers\Auth\NewPasswordController::class, 'store'])
        ->name('password.update');
});

Route::middleware('auth')->group(function () {
    Route::get('verify-email', [\App\Http\Controllers\Auth\EmailVerificationPromptController::class, '__invoke'])
        ->name('verification.notice');
    Route::get('verify-email/{id}/{hash}', [\App\Http\Controllers\Auth\VerifyEmailController::class, '__invoke'])
        ->middleware(['signed', 'throttle:6,1'])
        ->name('verification.verify');
    Route::post('email/verification-notification', [\App\Http\Controllers\Auth\EmailVerificationNotificationController::class, 'store'])
        ->middleware('throttle:6,1')
        ->name('verification.send');
    
    Route::get('confirm-password', [\App\Http\Controllers\Auth\ConfirmablePasswordController::class, 'show'])
        ->name('password.confirm');
    Route::post('confirm-password', [\App\Http\Controllers\Auth\ConfirmablePasswordController::class, 'store']);
    
    Route::post('logout', [\App\Http\Controllers\Auth\AuthenticatedSessionController::class, 'destroy'])
        ->name('logout');
});

// Protected routes
Route::middleware(['auth'])->group(function () {
    // Dashboard
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    
    // Profile routes
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    
    // Password update route
    Route::put('password', [PasswordController::class, 'update'])->name('password.update');

    Route::get("/locations", [TempatSampahController::class, 'location'])->name("locations.index");
    Route::get("/status", [TempatSampahController::class, 'dashboard'])->name("status.index");
    Route::get("/history", [RiwayatPembuanganController::class, 'index'])->name("history.index");
    
    // Notifications
    Route::get('/notifications', [NotificationController::class, 'index'])->name('notifications.index');
    Route::post('/notifications/{id}/mark-as-read', [NotificationController::class, 'markAsRead'])->name('notifications.mark-as-read');
    Route::post('/notifications/mark-all-as-read', [NotificationController::class, 'markAllAsRead'])->name('notifications.mark-all-as-read');
    Route::delete('/notifications/{id}', [NotificationController::class, 'destroy'])->name('notifications.destroy');
    
    // Admin only routes
    Route::middleware(['auth'])->group(function () {
        Route::resource('users', UserController::class);
    });
});

// API routes for IoT devices
Route::prefix('api')->group(function () {
    Route::post('/trash-data', [TrashBinController::class, 'postData'])->name('api.trash-data');
});
<<<<<<< Updated upstream
=======

Route::get('/user/index', function () {
    return view('user.index');
})->name('user.index');

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

Route::get('/user/edituser', function () {
    return view('user.edituser');
})->name('user.edituser');

#logout
Route::post('/logout', function () {
    // Logika logout di sini
    return redirect('/');
})->name('logout');

Route::get('/janitor/index', function () {
    return view('janitor.index');
})->name('janitor.index');

Route::get('/janitor/dashboard', function () {
    return view('janitor.dashboard');
})->name('janitor.dashboard');

Route::get('/janitor/status', function () {
    return view('janitor.status');
})->name('janitor.status');

Route::get('/janitor/location', function () {
    return view('janitor.location');
})->name('janitor.location');

Route::get('/janitor/history', function () {
    return view('janitor.history');
})->name('janitor.history');

Route::get('/janitor/editjanitor', function () {
    return view('janitor.editjanitor');
})->name('janitor.editjanitor');

#logout
Route::post('/logout', function () {
    // Logika logout di sini
    return redirect('/');
})->name('logout');



require __DIR__.'/auth.php';
>>>>>>> Stashed changes
