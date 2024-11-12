<div class="max-w-7xl mx-auto">
    <div class="bg-white shadow-lg rounded-lg p-6">
        <h2 class="text-2xl font-bold text-gray-900 mb-6">Form Pemesanan Tiket</h2>

        <!-- Paket Tiket Section -->
        <div class="mb-8">
            <h3 class="text-lg font-medium text-gray-900 mb-4">Pilih Paket Tiket</h3>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                @foreach($pakets as $paket)
                    <div class="relative">
                        <input type="radio" name="paket" id="paket_{{ $paket['id'] }}"
                            wire:model="selectedPaket" value="{{ $paket['id'] }}"
                            class="peer hidden">
                        <label for="paket_{{ $paket['id'] }}"
                            class="block p-6 bg-white border rounded-lg cursor-pointer 
                            peer-checked:border-primary-500 peer-checked:ring-2 peer-checked:ring-primary-500
                            hover:border-primary-200 transition-all duration-200">
                            <div class="flex flex-col h-full">
                                <div class="mb-4">
                                    <h4 class="text-xl font-semibold text-gray-900">{{ $paket['nama'] }}</h4>
                                    <p class="text-sm text-gray-500">{{ $paket['deskripsi'] }}</p>
                                </div>
                                <div class="mb-4 flex-grow">
                                    <ul class="space-y-2">
                                        @foreach($paket['fitur'] as $fitur)
                                            <li class="flex items-center text-sm text-gray-600">
                                                <svg class="h-4 w-4 text-green-500 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                                                </svg>
                                                {{ $fitur }}
                                            </li>
                                        @endforeach
                                    </ul>
                                </div>
                                <div class="mt-auto">
                                    <div class="text-2xl font-bold text-primary-600">
                                        Rp {{ number_format($paket['harga'], 0, ',', '.') }}
                                    </div>
                                    <div class="text-sm text-gray-500">
                                        Untuk {{ $paket['jumlah_orang'] }} orang
                                    </div>
                                </div>
                            </div>
                        </label>
                    </div>
                @endforeach
            </div>
            @error('selectedPaket')
                <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
            @enderror
        </div>

        <!-- Form Pemesanan Section -->
        <form wire:submit.prevent="submit" class="space-y-6">
            @if (session()->has('message'))
                <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative">
                    {{ session('message') }}
                </div>
            @endif

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <label for="nama_pgj" class="block text-sm font-medium text-gray-700">Nama Lengkap</label>
                    <input type="text" id="nama_pgj" wire:model="nama_pgj" 
                        class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-primary-500 focus:ring-primary-500">
                    @error('nama_pgj') 
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="email_pgj" class="block text-sm font-medium text-gray-700">Email</label>
                    <input type="email" id="email_pgj" wire:model="email_pgj" 
                        class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-primary-500 focus:ring-primary-500">
                    @error('email_pgj')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="nomor_pgj" class="block text-sm font-medium text-gray-700">Nomor Telepon</label>
                    <input type="text" id="nomor_pgj" wire:model="nomor_pgj" 
                        class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-primary-500 focus:ring-primary-500">
                    @error('nomor_pgj')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="tanggal" class="block text-sm font-medium text-gray-700">Tanggal Kunjungan</label>
                    <input type="date" id="tanggal" wire:model="tanggal"
                        class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-primary-500 focus:ring-primary-500">
                    @error('tanggal')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>
            </div>

            <!-- Order Summary -->
            @if($paketDetail)
                <div class="mt-8 p-4 bg-gray-50 rounded-lg">
                    <h4 class="text-lg font-medium text-gray-900 mb-4">Ringkasan Pesanan</h4>
                    <div class="space-y-2">
                        <div class="flex justify-between">
                            <span class="text-gray-600">Paket</span>
                            <span class="font-medium">{{ $paketDetail['nama'] }}</span>
                        </div>
                        <div class="flex justify-between">
                            <span class="text-gray-600">Jumlah Orang</span>
                            <span class="font-medium">{{ $paketDetail['jumlah_orang'] }} orang</span>
                        </div>
                        <div class="flex justify-between text-lg font-bold text-primary-600">
                            <span>Total</span>
                            <span>Rp {{ number_format($paketDetail['harga'], 0, ',', '.') }}</span>
                        </div>
                    </div>
                </div>
            @endif

            <div class="pt-4">
                <button type="submit"
                    class="w-full flex justify-center py-2 px-4 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-primary-600 hover:bg-primary-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-primary-500">
                    Pesan Sekarang
                </button>
            </div>
        </form>
    </div>
</div>