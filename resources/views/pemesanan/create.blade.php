<!-- resources/views/pemesanan/create.blade.php -->
@extends('layouts.app')

@section('content')
@section('content')
<div class="max-w-3xl mx-auto">
    <div class="bg-white shadow-lg rounded-lg p-8">
        <h2 class="text-2xl font-bold text-gray-900 mb-8">Form Pemesanan Tiket</h2>

            <!-- resources/views/pemesanan/create.blade.php -->
            <form action="{{ route('pemesanan.store') }}" method="POST" enctype="multipart/form-data" class="space-y-6">
            @csrf


            <!-- Package Selection -->
            <div class="mb-8">
                <h3 class="text-lg font-medium text-gray-900 mb-4">Pilih Paket Tiket</h3>
                <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                    @foreach($packages as $id => $package)
                        <div class="relative">
                            <input type="radio" name="package" id="package_{{ $id }}"
                                value="{{ $id }}" class="peer hidden"
                                {{ old('package') == $id ? 'checked' : '' }}>
                            <label for="package_{{ $id }}"
                                class="block bg-white border rounded-lg cursor-pointer 
                                peer-checked:border-blue-500 peer-checked:ring-2 peer-checked:ring-blue-500
                                hover:border-blue-200 transition-all duration-200">
                                
                                <!-- Package Image -->
                                <div class="aspect-video w-auto h-auto overflow-visible rounded-t-lg">
                                    <img src="{{ asset($package['image']) }}" 
                                        alt="{{ $package['name'] }}"
                                        class="w-full h-full object-contain">
                                </div>

                                <div class="p-3">
                                    <div class="mb-4">
                                        <h4 class="text-xl font-semibold text-gray-900">{{ $package['name'] }}</h4>
                                        <p class="text-sm text-gray-500">{{ $package['description'] }}</p>
                                    </div>
                                    
                                    <div class="mb-2">
                                        <ul class="space-y-2">
                                            @foreach($package['features'] as $feature)
                                                <li class="flex items-center text-sm text-gray-600">
                                                    <svg class="h-4 w-4 text-green-500 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                                                    </svg>
                                                    {{ $feature }}
                                                </li>
                                            @endforeach
                                        </ul>
                                    </div>

                                    <div class="pt-4 border-t">
                                        <div class="text-2xl font-bold text-blue-600">
                                            Rp {{ number_format($package['price'], 0, ',', '.') }}
                                        </div>
                                        <div class="text-sm text-gray-500">
                                            Untuk {{ $package['num_people'] }} orang
                                        </div>
                                    </div>
                                </div>
                            </label>
                        </div>
                    @endforeach
                </div>
                @error('package')
                    <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <!-- Personal Information -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-8">
                <div>
                    <label for="name" class="block text-sm font-medium text-gray-700">Nama Lengkap</label>
                    <input type="text" id="name" name="name" value="{{ old('name') }}"
                        class="mt-1 block w-full rounded-md border-gray-300 shadow-sm 
                        focus:border-blue-500 focus:ring-blue-500">
                    @error('name')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="email" class="block text-sm font-medium text-gray-700">Email</label>
                    <input type="email" id="email" name="email" value="{{ old('email') }}"
                        class="mt-1 block w-full rounded-md border-gray-300 shadow-sm 
                        focus:border-blue-500 focus:ring-blue-500">
                    @error('email')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="phone" class="block text-sm font-medium text-gray-700">Nomor Telepon</label>
                    <input type="text" id="phone" name="phone" value="{{ old('phone') }}"
                        class="mt-1 block w-full rounded-md border-gray-300 shadow-sm 
                        focus:border-blue-500 focus:ring-blue-500">
                    @error('phone')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="order_date" class="block text-sm font-medium text-gray-700">Tanggal Kunjungan</label>
                    <input type="date" id="order_date" name="order_date" value="{{ old('order_date') }}"
                        class="mt-1 block w-full rounded-md border-gray-300 shadow-sm 
                        focus:border-blue-500 focus:ring-blue-500">
                    @error('order_date')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>
            </div>

            <!-- Payment Proof -->
            <div class="mb-8">
                <label class="block text-sm font-medium text-gray-700">
                    Bukti Pembayaran
                    <span class="text-xs text-gray-500">(Format: JPG, PNG, max 2MB)</span>
                </label>
                <input type="file" name="proof_of_payment"
                    class="mt-1 block w-full text-sm text-gray-500
                    file:mr-4 file:py-2 file:px-4
                    file:rounded-full file:border-0
                    file:text-sm file:font-semibold
                    file:bg-blue-50 file:text-blue-700
                    hover:file:bg-blue-100">
                @error('proof_of_payment')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>
                
                <!-- Submit Button dan QRIS Button -->
                <div class="pt-4 flex gap-4">
                    <button type="submit" 
                        class="flex-1 bg-primary-600 text-white py-2 px-4 rounded-md hover:bg-primary-700 
                        focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-primary-500">
                        Pesan Sekarang
                    </button>
                    <button type="button"
                        onclick="showQRIS()"
                        class="bg-green-600 text-white py-2 px-4 rounded-md hover:bg-green-700 
                        focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500">
                        Lihat QRIS
                    </button>
                </div>
            </div>
        </form>
    </div>
</div>

<!-- Modal QRIS -->
<div id="qrisModal" 
    class="hidden fixed inset-0 bg-gray-600 bg-opacity-50 overflow-y-auto h-full w-full z-50">
    <div class="relative top-20 mx-auto p-5 border w-96 shadow-lg rounded-md bg-white">
        <div class="flex flex-col items-center">
            <h3 class="text-lg font-medium text-gray-900 mb-4">Scan QRIS untuk Pembayaran</h3>
            <div class="mb-4">
                <img src="{{ asset('img/qris.jpg') }}" alt="QRIS Code" class="max-w-full h-auto rounded-lg">
            </div>
            <button type="button" 
                onclick="hideQRIS()"
                class="mt-3 bg-gray-600 text-white px-4 py-2 rounded-md hover:bg-gray-700 
                focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-gray-500">
                Tutup
            </button>
        </div>
    </div>
</div>

@push('scripts')
<script>
    function showQRIS() {
        document.getElementById('qrisModal').classList.remove('hidden');
        document.body.style.overflow = 'hidden'; // Prevent scrolling when modal is open
    }

    function hideQRIS() {
        document.getElementById('qrisModal').classList.add('hidden');
        document.body.style.overflow = 'auto'; // Restore scrolling
    }

    // Close modal when clicking outside
    document.getElementById('qrisModal').addEventListener('click', function(e) {
        if (e.target === this) {
            hideQRIS();
        }
    });

    // Close modal with ESC key
    document.addEventListener('keydown', function(e) {
        if (e.key === 'Escape') {
            hideQRIS();
        }
    });
</script>
@endpush
@endsection

