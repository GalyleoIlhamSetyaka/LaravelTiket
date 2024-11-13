<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Storage;
use App\Http\Livewire\PemesananForm;
use App\Http\Livewire\KonfirmasiForm;
use App\Http\Livewire\IndexPage;

Route::middleware(['web'])->group(function () {
    // Index route
    Route::get('/', function () {
        return view('index');
    });
        
    // Pemesanan routes
    Route::get('/pemesanan', PemesananForm::class)->name('pemesanan.index');
    Route::get('/pemesanan/create', PemesananForm::class)->name('pemesanan.create');
    
    // Konfirmasi routes
    Route::get('/konfirmasi', KonfirmasiForm::class)->name('konfirmasi.index');
    Route::get('/konfirmasi/create', KonfirmasiForm::class)->name('konfirmasi.create');
    
    // Bukti transfer route
    Route::get('bukti-transfer/{filename}', function ($filename) {
        $path = 'bukti-transfer/' . $filename;
        if (!Storage::disk('public')->exists($path)) {
            abort(404);
        }
        return response()->file(Storage::disk('public')->path($path));
    })->name('bukti-transfer.show');
});

