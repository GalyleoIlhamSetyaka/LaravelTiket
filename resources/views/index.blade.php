<!-- resources/views/livewire/index-page.blade.php -->
@extends('layouts.app')

@section('title', 'Beranda')

@section('content')
<div>
    <!-- Hero Section -->
    <div class="section bg-gray-100 py-16" id="deskripsi">
        <div class="container mx-auto">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-8 items-center">
                <div>
                    <h1 class="text-4xl font-bold mb-4">Hutan Pinusan Kalilo</h1>
                    <p class="mb-8 text-lg">
                        Hutan Pinusan Kalilo merupakan destinasi wisata yang berada di Desa Tlogoguwo, Kecamatan Kaligesing,
                        Kabupaten Purworejo, Jawa Tengah. Selain di suguhkan dengan pemandangan yang sangai indah, banyak spot
                        foto yang menarik di Hutan Pinusan Kalilo
                    </p>
                    @if (Auth::check())
                    <a href="{{ route('pemesanan.create') }}" class="bg-blue-600 text-white px-6 py-3 rounded-lg hover:bg-blue-700">PESAN SEKARANG</a>
                    @else
                    <a href="{{ route('login') }}" class="bg-blue-600 text-white px-6 py-3 rounded-lg hover:bg-blue-700">PESAN SEKARANG</a>
                    @endif                </div>
                <div>
                    <img src="{{ asset('img/tmbnl.jpg') }}" alt="Thumbnail" class="w-full rounded-lg shadow-md">
                </div>
            </div>
        </div>
    </div>

    <!--Virtual Tour Section-->
    <section class="py-16" id="VirtualTour">
        <div class="container mx-auto px-4">
            <h2 class="text-3xl font-bold text-center mb-8">Virtual Tour</h2>
            <div style="--aspect-ratio: 16/9">
                <iframe
                    height="800"
                    src="https://app.lapentor.com/sphere/kalilo"
                    width="100%"
                    title="Virtual Tour"
                ></iframe>
            </div>
        </div>
    </section>

    <!-- Gallery Section -->
    <section class="py-16" id="Galleri">
        <div class="container mx-auto px-4">
            <h2 class="text-3xl font-bold text-center mb-8">Galleri</h2>
            <div class="grid grid-cols-1 md:grid-cols-4 gap-6">
                @foreach(['bg.jpg', 'hom.jpg', 'kalilo2.jpeg', 'tmbnl.jpg'] as $image)
                <div class="overflow-hidden rounded-lg shadow-lg">
                    <img src="{{ asset('img/' . $image) }}" class="w-full h-64 object-cover" alt="Gallery Image">
                </div>
                @endforeach
            </div>
        </div>
    </section>

    <!-- How to Order Section -->
    <section class="py-16" id="CaraMemesan">
        <div class="container mx-auto px-4">
            <h2 class="text-3xl font-bold text-center mb-8">Cara Memesan</h2>
            <div class="grid grid-cols-1 md:grid-cols-4 gap-6">
                <div class="bg-white rounded-lg shadow-lg overflow-hidden">
                    <img src="{{ asset('img/cara/fr1.png') }}" class="w-full h-48 object-cover" alt="Step 1">
                    <div class="p-4 text-center">
                        <p>Tekan menu pesan sekarang</p>
                    </div>
                </div>
                <div class="bg-white rounded-lg shadow-lg overflow-hidden">
                    <img src="{{ asset('img/cara/fr2.png') }}" class="w-full h-48 object-cover" alt="Step 2">
                    <div class="p-4 text-center">
                        <p>Isi form pemesanan</p>
                    </div>
                </div>
                <div class="bg-white rounded-lg shadow-lg overflow-hidden">
                    <img src="{{ asset('img/cara/fr3.png') }}" class="w-full h-48 object-cover" alt="Step 3">
                    <div class="p-4 text-center">
                        <p>Lakukan pembayaran dan masukan bukti di form pemesanan</p>
                    </div>
                </div>
                <div class="bg-white rounded-lg shadow-lg overflow-hidden">
                    <img src="{{ asset('img/cara/fr4.png') }}" class="w-full h-48 object-cover" alt="Step 4">
                    <div class="p-4 text-center">
                        <p>Setelah pemesanan di konfirmasi tiket akan di kirimkan melalui email</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Contact Section -->
    <section class="py-16" id="contact">
        <div class="container mx-auto px-4">
            <h2 class="text-3xl font-bold text-center mb-8">Tentang Kami</h2>
            <div class="max-w-md mx-auto">
                <form>
                    <div class="mb-4">
                        <label class="block mb-2">Nama Lengkap</label>
                        <input type="text" class="w-full p-2 border rounded">
                    </div>
                    <div class="mb-4">
                        <label class="block mb-2">Email</label>
                        <input type="email" class="w-full p-2 border rounded">
                    </div>
                    <div class="mb-4">
                        <label class="block mb-2">Pesan</label>
                        <textarea class="w-full p-2 border rounded" rows="4"></textarea>
                    </div>
                    <button type="submit" class="bg-blue-600 text-white px-6 py-2 rounded hover:bg-blue-700">Kirim</button>
                </form>
            </div>
        </div>
        
    </section>
</div>
@endsection

