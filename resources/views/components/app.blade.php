// resources/views/components/layouts/app.blade.php
<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ config('app.name') }}</title>
    
    <!-- Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com"></script>
    
    @livewireStyles
</head>
<body>
    <!-- Navigation -->
    <nav class="bg-white shadow-lg">
        <div class="container mx-auto px-4">
            <div class="flex justify-between items-center py-4">
                <a href="{{ route('index') }}" class="text-xl font-bold">
                    {{ config('app.name') }}
                </a>
                <div class="space-x-4">
                    <a href="{{ route('pemesanan.index') }}" class="text-gray-600 hover:text-gray-900">Pemesanan</a>
                    <a href="{{ route('konfirmasi.index') }}" class="text-gray-600 hover:text-gray-900">Konfirmasi</a>
                </div>
            </div>
        </div>
    </nav>

    <!-- Main Content -->
    <main>
        {{ $slot }}
    </main>

    <!-- Footer -->
    <footer class="bg-gray-100 py-6 mt-12">
        <div class="container mx-auto px-4 text-center text-gray-600">
            <p>&copy; {{ date('Y') }} {{ config('app.name') }}. All rights reserved.</p>
        </div>
    </footer>

    @livewireScripts
</body>
</html>