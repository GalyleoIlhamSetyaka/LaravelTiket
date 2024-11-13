<!-- resources/views/layouts/app.blade.php -->
<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Hutan Pinusan Kalilo</title>

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
    <nav class="bg-white shadow">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between items-center h-16">
                <a href="{{ route('index') }}" class="text-xl font-bold text-gray-800">Hutan Pinusan Kalilo</a>
                <div class="flex space-x-4">
                    <a href="{{ route('pemesanan.create') }}" class="text-gray-600 hover:text-gray-900">Pesan Tiket</a>
                    <a href="{{ route('konfirmasi.create') }}" class="text-gray-600 hover:text-gray-900">Konfirmasi</a>
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
    <footer class="bg-white mt-auto">
        <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
            <p class="text-center text-gray-600">
                © {{ date('Y') }} Hutan Pinusan Kalilo. Created by 
                <a href="https://www.instagram.com/ilhams.13d/" class="text-blue-600 hover:underline">Ilham Setyaka</a>
            </p>
        </div>
    </footer>

    @stack('scripts')
</body>
</html>