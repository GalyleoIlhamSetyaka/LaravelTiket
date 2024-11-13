<!-- resources/views/pemesanan/create.blade.php -->
@extends('layouts.app')

@section('content')
<div class="max-w-3xl mx-auto">
    <div class="bg-white shadow-lg rounded-lg p-8">
        <h2 class="text-2xl font-bold text-gray-900 mb-8">Form Pemesanan Tiket</h2>

        <form action="{{ route('pemesanan.store') }}" method="POST" class="space-y-6">
            @csrf

            @if(session('success'))
                <div class="bg-green-50 border border-green-200 text-green-700 px-4 py-3 rounded">
                    {{ session('success') }}
                </div>
            @endif

            <div class="space-y-6">
                <!-- Nama Lengkap -->
                <div>
                    <label for="nama_pgj" class="block text-sm font-medium text-gray-700">Nama Lengkap</label>
                    <input type="text" id="nama_pgj" name="nama_pgj" value="{{ old('nama_pgj') }}"
                        class="mt-1 block w-full border-gray-300 rounded-md shadow-sm 
                        focus:ring-primary-500 focus:border-primary-500"
                        placeholder="Masukkan nama lengkap">
                    @error('nama_pgj')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Email -->
                <div>
                    <label for="email_pgj" class="block text-sm font-medium text-gray-700">Email</label>
                    <input type="email" id="email_pgj" name="email_pgj" value="{{ old('email_pgj') }}"
                        class="mt-1 block w-full border-gray-300 rounded-md shadow-sm 
                        focus:ring-primary-500 focus:border-primary-500"
                        placeholder="Masukkan email">
                    @error('email_pgj')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Nomor Telepon -->
                <div>
                    <label for="nomor_pgj" class="block text-sm font-medium text-gray-700">Nomor Telepon</label>
                    <input type="text" id="nomor_pgj" name="nomor_pgj" value="{{ old('nomor_pgj') }}"
                        class="mt-1 block w-full border-gray-300 rounded-md shadow-sm 
                        focus:ring-primary-500 focus:border-primary-500"
                        placeholder="Masukkan nomor telepon">
                    @error('nomor_pgj')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Tanggal Kunjungan -->
                <div>
                    <label for="tanggal" class="block text-sm font-medium text-gray-700">Tanggal Kunjungan</label>
                    <input type="date" id="tanggal" name="tanggal" value="{{ old('tanggal') }}"
                        class="mt-1 block w-full border-gray-300 rounded-md shadow-sm 
                        focus:ring-primary-500 focus:border-primary-500">
                    @error('tanggal')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Pilih Paket -->
                <div>
                    <label for="paket" class="block text-sm font-medium text-gray-700">Pilih Paket</label>
                    <select id="paket" name="paket" 
                        class="mt-1 block w-full border-gray-300 rounded-md shadow-sm 
                        focus:ring-primary-500 focus:border-primary-500">
                        <option value="">Pilih paket tiket</option>
                        @foreach($pakets as $id => $paket)
                            <option value="{{ $id }}" {{ old('paket') == $id ? 'selected' : '' }}>
                                {{ $paket['nama'] }} - Rp {{ number_format($paket['harga'], 0, ',', '.') }}
                            </option>
                        @endforeach
                    </select>
                    @error('paket')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>
                
                <!-- Submit Button -->
                <div class="pt-4">
                    <button type="submit" 
                        class="w-full bg-primary-600 text-white py-2 px-4 rounded-md hover:bg-primary-700 
                        focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-primary-500">
                        Pesan Sekarang
                    </button>
                </div>
            </div>
        </form>
    </div>
</div>
@endsection