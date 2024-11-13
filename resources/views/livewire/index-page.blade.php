<!-- resources/views/livewire/index-page.blade.php -->
<div>
    <!-- Navbar -->
    <nav class="container mx-auto py-4">
            
            <div class="collapse navbar-collapse w-full md:w-auto md:flex" id="navbarContent">
                <ul class="flex flex-col md:flex-row items-center gap-4">
                    <li>
                        <a href="{{ route('pemesanan.create') }}" class="block py-2 px-4 hover:bg-gray-200 rounded">Pesan Sekarang</a>
                    </li>
                    <li>
                        <a href="#Memesan" class="block py-2 px-4 hover:bg-gray-200 rounded">Cara memesan</a>
                    </li>
                    <li>
                        <a href="#contact" class="block py-2 px-4 hover:bg-gray-200 rounded">Tentang kami</a>
                    </li>
                    <li>
                        <a href="login.html">
                            <img src="{{ asset('img/3917705.svg') }}" class="w-10 h-10" alt="Login">
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- Hero Section -->
    <section class="bg-gray-100 py-16" id="deskripsi">
        <div class="container mx-auto px-4">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-8 items-center">
                <div>
                    <h1 class="text-4xl font-bold mb-4">Hutan Pinusan Kalilo</h1>
                    <p class="mb-8 text-lg">
                        Hutan Pinusan Kalilo merupakan destinasi wisata yang berada di Desa Tlogoguwo, Kecamatan Kaligesing,
                        Kabupaten Purworejo, Jawa Tengah. Selain di suguhkan dengan pemandangan yang sangai indah, banyak spot
                        foto yang menarik di Hutan Pinusan Kalilo
                    </p>
                    <a href="{{ route('pemesanan.create') }}" class="inline-block bg-blue-600 text-white px-6 py-3 rounded-lg hover:bg-blue-700">PESAN SEKARANG</a>
                </div>
                <div>
                    <img src="{{ asset('img/tmbnl.jpg') }}" alt="Thumbnail" class="w-full rounded-lg shadow-lg">
                </div>
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
    <section class="py-16 bg-gray-50" id="Memesan">
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
        
        <div class="mt-16">
            <img src="data:image/svg+xml;base64,PHN2ZyB4bWxucz0iaHR0cDovL3d3dy53My5vcmcvMjAwMC9zdmciIHZpZXdib3g9IjAgMCAxNDQwIDMyMCI+CiAgICAgICAgPHBhdGggZmlsbD0iIzY5YmQ4NSIgZmlsbC1vcGFjaXR5PSIxIiBkPSJNMCwyMjRMNDgsMjI5LjNDOTYsMjM1LDE5MiwyNDUsMjg4LDI0NS4zQzM4NCwyNDUsNDgwLDIzNSw1NzYsMjE4LjdDNjcyLDIwMyw3NjgsMTgxLDg2NCwxODEuM0M5NjAsMTgxLDEwNTYsMjAzLDExNTIsMjE4LjdDMTI0OCwyMzUsMTM0NCwyNDUsMTM5MiwyNTAuN0wxNDQwLDI1NkwxNDQwLDMyMEwxMzkyLDMyMEMxMzQ0LDMyMCwxMjQ4LDMyMCwxMTUyLDMyMEMxMDU2LDMyMCw5NjAsMzIwLDg2NCwzMjBDNzY4LDMyMCw2NzIsMzIwLDU3NiwzMjBDNDgwLDMyMCwzODQsMzIwLDI4OCwzMjBDMTkyLDMyMCw5NiwzMjAsNDgsMzIwTDAsMzIwWiIgLz4KICAgICAgPC9zdmc+" class="w-full">
            <p class="text-center py-4">
                Created by <a href="https://www.instagram.com/ilhams.13d/" class="text-blue-600 hover:underline">Ilham Setyaka</a>
            </p>
        </div>
    </section>
</div>