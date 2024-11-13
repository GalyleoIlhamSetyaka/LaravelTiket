<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PemesananController;
use App\Http\Controllers\KonfirmasiController;
use Illuminate\Support\Facades\Storage;
use app\Http\Livewire\IndexPage;
use app\Http\Livewire\PemesananForm;
use resources\views\components\layout\app;

// Route untuk halaman utama
Route::get('/', function () {
    return view('index');
})->name('index');

// Route untuk pemesanan
Route::prefix('pemesanan')->group(function () {
    Route::get('/', [PemesananController::class, 'index'])->name('pemesanan.index');
    Route::get('/create', [PemesananController::class, 'create'])->name('pemesanan.create');
    Route::post('/store', [PemesananController::class, 'store'])->name('pemesanan.store');
});

// Route untuk konfirmasi
Route::prefix('konfirmasi')->group(function () {
    Route::get('/', [KonfirmasiController::class, 'index'])->name('konfirmasi.index');
    Route::get('/create', [KonfirmasiController::class, 'create'])->name('konfirmasi.create');
    Route::post('/store', [KonfirmasiController::class, 'store'])->name('konfirmasi.store');
});

// Route untuk bukti transfer
Route::get('bukti-transfer/{filename}', function ($filename) {
    $path = 'bukti-transfer/' . $filename;
    if (!Storage::disk('public')->exists($path)) {
        abort(404);
    }
    return response()->file(Storage::disk('public')->path($path));
})->name('bukti-transfer.show');