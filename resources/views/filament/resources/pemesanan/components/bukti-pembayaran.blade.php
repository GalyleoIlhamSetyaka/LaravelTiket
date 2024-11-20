<!-- resources/views/filament/resources/pemesanan/components/bukti-pembayaran.blade.php -->
<div class="flex flex-col items-center gap-2">
    @if($getRecord()->proof_of_payment)
        <img src="{{ Storage::disk('public')->url($getRecord()->proof_of_payment) }}" 
             alt="Bukti Pembayaran" 
             class="w-full max-w-sm rounded-lg shadow-lg">
        <x-filament::button
            type="button"
            color="primary"
            icon="heroicon-o-check-circle"
            onclick="window.open('{{ Storage::disk('public')->url($getRecord()->proof_of_payment) }}', '_blank')"
        >
            Lihat Bukti Pembayaran
        </x-filament::button>
    @else
        <p class="text-gray-500">Tidak ada bukti pembayaran</p>
    @endif
</div>