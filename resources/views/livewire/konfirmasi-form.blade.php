<!-- resources/views/livewire/konfirmasi-form.blade.php -->
<div class="max-w-2xl mx-auto">
    <div class="bg-white shadow-lg rounded-lg p-6">
        <h2 class="text-2xl font-bold text-gray-900 mb-6">Konfirmasi Pembayaran</h2>
        
        <form wire:submit.prevent="submit" class="space-y-6">
            @if (session()->has('message'))
                <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative">
                    {{ session('message') }}
                </div>
            @endif

            @if (session()->has('error'))
                <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative">
                    {{ session('error') }}
                </div>
            @endif

            <div>
                <label for="kode_pemesanan" class="block text-sm font-medium text-gray-700">Kode Pemesanan</label>
                <input type="text" id="kode_pemesanan" wire:model="kode_pemesanan"
                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-primary-500 focus:ring-primary-500">
                @error('kode_pemesanan')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            @if($pemesanan_detail)
                <div class="bg-gray-50 p-4 rounded-lg">
                    <h3 class="font-medium text-gray-900 mb-2">Detail Pemesanan:</h3>
                    <div class="space-y-2 text-sm">
                        <p><span class="text-gray-600">Nama:</span> {{ $pemesanan_detail->nama_pgj }}</p>
                        <p><span class="text-gray-600">Jumlah Orang:</span> {{ $pemesanan_detail->jumlah_orang }}</p>
                        <p><span class="text-gray-600">Total Pembayaran:</span> Rp {{ number_format($pemesanan_detail->harga, 0, ',', '.') }}</p>
                    </div>
                </div>
            @endif

            <div>
                <label class="block text-sm font-medium text-gray-700">Bukti Transfer</label>
                <div class="mt-1 flex justify-center px-6 pt-5 pb-6 border-2 border-gray-300 border-dashed rounded-md">
                    <div class="space-y-1 text-center">
                        @if ($preview_image)
                            <div class="mb-4">
                                <img src="{{ $preview_image }}" alt="Preview" class="mx-auto h-32 w-auto">
                            </div>
                        @else
                            <svg class="mx-auto h-12 w-12 text-gray-400" stroke="currentColor" fill="none" viewBox="0 0 48 48">
                                <path d="M28 8H12a4 4 0 00-4 4v20m32-12v8m0 0v8a4 4 0 01-4 4H12a4 4 0 01-4-4v-4m32-4l-3.172-3.172a4 4 0 00-5.656 0L28 28M8 32l9.172-9.172a4 4 0 015.656 0L28 28m0 0l4 4m4-24h8m-4-4v8m-12 4h.02" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                            </svg>
                        @endif
                        <div class="flex text-sm text-gray-600">
                            <label for="bukti_transfer" class="relative cursor-pointer bg-white rounded-md font-medium text-primary-600 hover:text-primary-500 focus-within:outline-none focus-within:ring-2 focus-within:ring-offset-2 focus-within:ring-primary-500">
                                <span>Upload file</span>
                                <input id="bukti_transfer" wire:model="bukti_transfer" type="file" class="sr-only"
                                    accept="image/*">
                            </label>
                            <p class="pl-1">atau drag and drop</p>
                        </div>
                        <p class="text-xs text-gray-500">PNG, JPG up to 2MB</p>
                    </div>
                </div>
                <div wire:loading wire:target="bukti_transfer" class="mt-2 text-sm text-gray-500">
                    Uploading...
                </div>
                @error('bukti_transfer')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <div class="pt-4">
                <button type="submit"
                    class="w-full flex justify-center py-2 px-4 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-primary-600 hover:bg-primary-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-primary-500"
                    wire:loading.attr="disabled"
                    wire:loading.class="opacity-50 cursor-not-allowed">
                    <span wire:loading.remove wire:target="submit">
                        Kirim Konfirmasi
                    </span>
                    <span wire:loading wire:target="submit">
                        Memproses...
                    </span>
                </button>
            </div>
        </form>
    </div>
</div>