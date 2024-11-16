<!-- resources/views/layouts/app.blade.php -->
<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Hutan Pinusan Kalilo</title>

    <script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        primary: {
                            '500': '#3B82F6',
                            '600': '#2563EB',
                            '700': '#1D4ED8',
                        }
                    }
                }
            }
        }
    </script>
</head>
<body class="bg-gray-100">
    <!-- Navbar -->
    <nav class="flex-no-wrap fixed top-0 flex w-full items-center justify-between bg-[#FBFBFB] py-4 lg:flex-wrap lg:justify-start lg:py-4 z-10">
        <div class="max-w-7xl mx-auto w-full">
            <div class="flex items-center justify-between w-full">
                <a href="{{ route('home') }}" class="text-xl font-bold text-gray-800">Hutan Pinusan Kalilo</a>
                <div class="flex items-center space-x-4 ml-auto">
                    <a href="{{ route('pemesanan.create') }}" class="text-gray-600 hover:text-gray-900">Pesan Tiket</a>
                    <a href="#Galleri" class="text-gray-600 hover:text-gray-900">Galleri</a>
                    <a href="#CaraMemesan" class="text-gray-600 hover:text-gray-900">Cara Memesan</a>
                    <a href="#TentangKami" class="text-gray-600 hover:text-gray-900">Kontak Kami</a>

                    @auth <!-- Tampilkan ini jika user sudah login -->
                        <div class="relative" x-data="{ open: false }">
                            <button @click="open = !open" class="flex items-center space-x-2 text-gray-600 hover:text-gray-900">
                                <span>{{ Auth::user()->name }}</span>
                                <img src="{{ asset('img/3917705.svg') }}" alt="profile" class="w-7 h-7 rounded-full">
                            </button>
                            
                            <!-- Dropdown Menu -->
                            <div x-show="open" 
                                @click.away="open = false"
                                class="absolute right-0 mt-2 w-48 bg-white rounded-md shadow-lg py-1">
                                <a href="{{ route('profile') }}" 
                                    class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">
                                    Profile
                                </a>
                                <form method="POST" action="{{ route('logout') }}">
                                    @csrf
                                    <button type="submit" 
                                        class="block w-full text-left px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">
                                        Logout
                                    </button>
                                </form>
                            </div>
                        </div>
                    @else <!-- Tampilkan ini jika user belum login -->
                        <a href="{{ route('login') }}" class="text-gray-600 hover:text-gray-900">
                            <img src="{{ asset('img/3917705.svg') }}" alt="login" class="inline-block w-7 h-7" />
                        </a>
                    @endauth
                </div>
            </div>
        </div>
    </nav>

    <!-- Content -->
    <main class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            @yield('content')
        </div>
    </main>

    <!-- Footer -->
    <footer class="bg-white mt-auto inset-x-0 bottom-0">
        <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
            <p class="text-center text-gray-600">
                © {{ date('Y') }} Hutan Pinusan Kalilo. Created by 
                <a href="https://github.com/GalyleoIlhamSetyaka" class="text-blue-600 hover:underline">Ilham Setyaka</a>
            </p>
        </div>
    </footer>

    @stack('scripts')
</body>
</html>