// resources/views/layouts/app.blade.php
<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Hutan Pinusan Kalilo - @yield('title')</title>

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body>
    <!-- Navbar -->
    <nav class="bg-white shadow-lg">
        <div class="container mx-auto px-4">
            <div class="flex justify-between items-center py-4">
                <a href="{{ route('index') }}" class="text-xl font-bold">Hutan Pinusan Kalilo</a>
                <div class="space-x-4">
                    <a href="{{ route('pemesanan.create') }}" class="text-gray-600 hover:text-gray-900">Pesan Tiket</a>
                    <a href="{{ route('konfirmasi.create') }}" class="text-gray-600 hover:text-gray-900">Konfirmasi</a>
                </div>
            </div>
        </div>
    </nav>

    <!-- Main Content -->
    <main class="min-h-screen bg-gray-50 py-8">
        @yield('content')
    </main>

    <!-- Footer -->
    <footer class="bg-white shadow-lg mt-8">
        <div class="container mx-auto px-4 py-6">
            <p class="text-center text-gray-600">
                &copy; {{ date('Y') }} Hutan Pinusan Kalilo. Created by 
                <a href="https://www.instagram.com/ilhams.13d/" class="text-blue-600 hover:underline">
                    Ilham Setyaka
                </a>
            </p>
        </div>
    </footer>

    <!-- Bootstrap Bundle dengan Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>