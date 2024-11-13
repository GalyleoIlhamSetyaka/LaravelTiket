<!-- resources/views/livewire/index-page.blade.php -->
<div>
    <div class="container mx-auto py-8">
        <div class="flex items-center justify-between mb-8">
            <a href="#home" class="navbar-brand ">Hutan Pinusan Kalilo</a>
            <button class="navbar-toggler block md:hidden" type="button" data-bs-toggle="collapse" data-bs-target="#navbarText"
                aria-controls="navbarText" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
        </div>

        <div class="collapse navbar-collapse md:block" id="navbarText">
            <ul class="navbar-nav flex items-center">
                <li class="nav-item">
                    <a href="pesan.html" class="nav-link block py-2 px-4 hover:bg-gray-200 rounded">Pesan Sekarang</a>
                </li>
                <li class="nav-item">
                    <a href="#Memesan" class="nav-link block py-2 px-4 hover:bg-gray-200 rounded">Cara memesan</a>
                </li>
                <li class="nav-item">
                    <a href="#contact" class="nav-link block py-2 px-4 hover:bg-gray-200 rounded">Tentang kami</a>
                </li>
                <li class="navbar-brand">
                    <a href="login.html">
                        <img src="{{ asset('img/3917705.svg') }}" class="w-10 h-10" alt="Bootstrap">
                    </a>
                </li>
            </ul>
        </div>
    </div>

    <div class="section bg-gray-100 py-16" id="deskripsi">
        <div class="container mx-auto">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-8 items-center">
                <div>
                    <h1 class="text-4xl font-bold mb-4">Hutan Hutan Pinusan Kalilo</h1>
                    <p class="mb-8 h1">
                        Hutan Pinusan Kalilo merupakan destinasi wisata yang berada di Desa Tlogoguwo, Kecamatan Kaligesing,
                        Kabupaten Purworejo, Jawa Tengah. Selain di suguhkan dengan pemandangan yang sangai indah, banyak spot
                        foto yang menarik di Hutan Pinusan Kalilo
                    </p>
                    <a href="pesan.html" class="btn btn-primary btn-lg text-right">PESAN SEKARANG</a>
                </div>
                <div>
                    <img src="{{ asset('img/tmbnl.jpg') }}" alt="Thumbnail" class="w-full rounded-lg shadow-md">
                </div>
            </div>
        </div>
    </div>

    <div class="section py-16" id="Galleri">
        <div class="container mx-auto">
            <div class="text-center mb-8">
                <h2 class="text-3xl font-bold">Galleri</h2>
            </div>
            <div class="grid grid-cols-1 md:grid-cols-4 gap-4">
                <div class="mb-4">
                    <div class="card rounded-lg overflow-hidden">
                        <img src="{{ asset('img/bg.jpg') }}" class="card-img-top" alt="Galleri1">
                    </div>
                </div>
                <div class="mb-4">
                    <div class="card rounded-lg overflow-hidden">
                        <img src="{{ asset('img/hom.jpg') }}" class="card-img-top" alt="Galleri2">
                    </div>
                </div>
                <div class="mb-4">
                    <div class="card rounded-lg overflow-hidden">
                        <img src="{{ asset('img/kalilo2.jpeg') }}" class="card-img-top" alt="Galleri3">
                    </div>
                </div>
                <div class="mb-4">
                    <div class="card rounded-lg overflow-hidden">
                        <img src="{{ asset('img/tmbnl.jpg') }}" class="card-img-top" alt="Galleri4">
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="section py-16" id="Memesan">
        <div class="container mx-auto">
            <div class="text-center mb-8">
                <h2 class="text-3xl font-bold">Cara Memesan</h2>
            </div>
            <div class="grid grid-cols-1 md:grid-cols-4 gap-4">
                <div class="mb-4">
                    <div class="card rounded-lg overflow-hidden">
                        <img src="{{ asset('img/cara/fr1.png') }}" class="card-img-top" alt="project2">
                        <div class="card-body text-center" style="width: 18rem; height: 5rem">
                            Tekan menu pesan sekarang
                        </div>
                    </div>
                </div>
                <div class="mb-4">
                    <div class="card rounded-lg overflow-hidden">
                        <img src="{{ asset('img/cara/fr2.png') }}" class="card-img-top" alt="project3">
                        <div class="card-body text-center" style="width: 18rem; height: 5rem">
                            Isi form pemesanan
                        </div>
                    </div>
                </div>
                <div class="mb-4">
                    <div class="card rounded-lg overflow-hidden">
                        <img src="{{ asset('img/cara/fr3.png') }}" class="card-img-top" alt="project3">
                        <div class="card-body text-center" style="width: 18rem; height: 5rem">
                            Lakukan pembayaran dan masukan bukti di form pemesanan
                        </div>
                    </div>
                </div>
                <div class="mb-4">
                    <div class="card rounded-lg overflow-hidden">
                        <img src="{{ asset('img/cara/fr4.png') }}" class="card-img-top" alt="project5">
                        <div class="card-body text-center" style="width: 18rem; height: 5rem">
                            Setelah pemesanan di konfirmasi tiket akan di kirimkan melalui email
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="section py-16" id="contact">
        <div class="container mx-auto">
            <div class="text-center mb-8">
                <h2 class="text-3xl font-bold">Tentang Kami</h2>
            </div>
            <div class="flex justify-center">
                <div class="w-full md:w-1/2">
                    <div class="mb-4">Nama Lengkap</div>
                    <div class="mb-4">Email</div>
                    <div class="mb-4">Pesan</div>
                    <button type="submit" class="btn btn-primary">Kirim</button>
                </div>
            </div>
        </div>
        <img src="data:image/svg+xml;base64,PHN2ZyB4bWxucz0iaHR0cDovL3d3dy53My5vcmcvMjAwMC9zdmciIHZpZXdib3g9IjAgMCAxNDQwIDMyMCI+CiAgICAgICAgPHBhdGggZmlsbD0iIzY5YmQ4NSIgZmlsbC1vcGFjaXR5PSIxIiBkPSJNMCwyMjRMNDgsMjI5LjNDOTYsMjM1LDE5MiwyNDUsMjg4LDI0NS4zQzM4NCwyNDUsNDgwLDIzNSw1NzYsMjE4LjdDNjcyLDIwMyw3NjgsMTgxLDg2NCwxODEuM0M5NjAsMTgxLDEwNTYsMjAzLDExNTIsMjE4LjdDMTI0OCwyMzUsMTM0NCwyNDUsMTM5MiwyNTAuN0wxNDQwLDI1NkwxNDQwLDMyMEwxMzkyLDMyMEMxMzQ0LDMyMCwxMjQ4LDMyMCwxMTUyLDMyMEMxMDU2LDMyMCw5NjAsMzIwLDg2NCwzMjBDNzY4LDMyMCw2NzIsMzIwLDU3NiwzMjBDNDgwLDMyMCwzODQsMzIwLDI4OCwzMjBDMTkyLDMyMCw5NiwzMjAsNDgsMzIwTDAsMzIwWiIgLz4KICAgICAgPC9zdmc+" class="w-full h-auto">
        <p class="text-black text-center">Created by <a href="https://www.instagram.com/ilhams.13d/" class="text-black">Ilham Setyaka</a></p>
    </div>
</div>