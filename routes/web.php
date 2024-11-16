<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PemesananController;
use App\Http\Controllers\KonfirmasiController;
use App\Http\Controllers\AuthController;
use Illuminate\Support\Facades\Storage;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

// Public Routes
Route::get('/', function () {
    return view('index');
})->name('home');

// Authentication Routes
Route::middleware('guest')->group(function () {
    // Login Routes
    Route::get('login', [AuthController::class, 'loginForm'])->name('login');
    Route::post('login', [AuthController::class, 'login']);
    
    // Register Routes
    Route::get('register', [AuthController::class, 'registerForm'])->name('register');
    Route::post('register', [AuthController::class, 'register']);
    
    // Password Reset Routes
    Route::get('forgot-password', [AuthController::class, 'forgotPassword'])
        ->name('password.request');
});

// Protected Routes
Route::middleware('auth')->group(function () {
    // Logout Route
    Route::post('logout', [AuthController::class, 'logout'])->name('logout');
    
    // Profile Routes
    Route::get('profile', [AuthController::class, 'profile'])->name('profile');
    Route::put('profile', [AuthController::class, 'updateProfile']);
    
    // Pemesanan Routes
    Route::resource('pemesanan', PemesananController::class);
    
    // Konfirmasi Routes
    Route::resource('konfirmasi', KonfirmasiController::class)->except(['show']);
    
    // Bukti Transfer Route
    Route::get('bukti-transfer/{filename}', function ($filename) {
        $path = 'bukti-transfer/' . $filename;
        if (!Storage::disk('public')->exists($path)) {
            abort(404);
        }
        return response()->file(Storage::disk('public')->path($path));
    })->name('bukti-transfer.show');
});