Copy<!-- resources/views/filament/resources/pemesanan/modal/image.blade.php -->
<div class="flex justify-center p-4">
    <img src="{{ Storage::disk('public')->url($pemesanan->proof_of_payment) }}"" 
         alt="Bukti Pembayaran" 
         class="max-w-full h-auto rounded-lg shadow-lg">
</div>