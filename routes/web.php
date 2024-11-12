<?php
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Route;
use App\Http\Livewire\PemesananForm;
use App\Http\Livewire\KonfirmasiForm;

Route::get('/', \App\Http\Livewire\IndexPage::class)->name('index');

Route::middleware(['web'])->group(function () {
    Route::get('/pemesanan', PemesananForm::class)->name('pemesanan.index');
    Route::get('/pemesanan/create', PemesananForm::class)->name('pemesanan.create');
    Route::get('/konfirmasi', KonfirmasiForm::class)->name('konfirmasi.index');
    Route::get('/konfirmasi/create', KonfirmasiForm::class)->name('konfirmasi.create');
});

Route::get('bukti-transfer/{filename}', function ($filename) {
    $path = 'bukti-transfer/' . $filename;
    if (!Storage::disk('public')->exists($path)) {
        abort(404);
    }
    return response()->file(Storage::disk('public')->path($path));
})->name('bukti-transfer.show');

require __DIR__.'/auth.php';