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
   <nav class="bg-white shadow-md fixed w-full z-50" x-data="{ isOpen: false }">
       <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
           <div class="flex justify-between h-16">
               <!-- Logo -->
               <div class="flex-shrink-0 flex items-center">
                   <a href="{{ route('home') }}" class="text-xl font-bold text-gray-800">
                       Hutan Pinusan Kalilo
                   </a>
               </div>

               <!-- Desktop Menu -->
               <div class="hidden md:flex md:items-center md:space-x-4">
                   <a href="{{ route('pemesanan.create') }}" class="text-gray-600 hover:text-gray-900">Pesan Tiket</a>
                   <a href="#Galleri" class="text-gray-600 hover:text-gray-900">Galleri</a>
                   <a href="#CaraMemesan" class="text-gray-600 hover:text-gray-900">Cara Memesan</a>
                   <a href="#TentangKami" class="text-gray-600 hover:text-gray-900">Kontak Kami</a>

                   @auth
                   <div class="relative ml-3" x-data="{ open: false }">
                       <button @click="open = !open" class="flex items-center space-x-2 text-gray-600 hover:text-gray-900">
                           <span>{{ Auth::user()->name }}</span>
                           <img src="{{ asset('img/3917705.svg') }}" alt="profile" class="w-7 h-7 rounded-full">
                       </button>
                       
                       <!-- Dropdown Menu -->
                       <div x-show="open" 
                           @click.away="open = false"
                           class="absolute right-0 mt-2 w-48 bg-white rounded-md shadow-lg py-1">
                           <a href="{{ route('pemesanan.create') }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">
                               Pesan Sekarang
                           </a>
                           <a href="{{ route('pemesanan.my-tickets') }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">
                               Tiket Saya
                           </a>
                           <form method="POST" action="{{ route('logout') }}">
                               @csrf
                               <button type="submit" class="block w-full text-left px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">
                                   Logout
                               </button>
                           </form>
                       </div>
                   </div>
                   @endauth
               </div>

               <!-- Mobile menu button -->
               <div class="md:hidden flex items-center">
                   <button @click="isOpen = !isOpen" class="text-gray-600 hover:text-gray-900 focus:outline-none">
                       <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                           <path x-show="!isOpen" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16m-7 6h7"/>
                           <path x-show="isOpen" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                       </svg>
                   </button>
               </div>
           </div>
       </div>

       <!-- Mobile Menu -->
       <div class="md:hidden" x-show="isOpen">
           <div class="px-2 pt-2 pb-3 space-y-1">
               <a href="{{ route('pemesanan.create') }}" class="block px-3 py-2 text-base font-medium text-gray-600 hover:text-gray-900 hover:bg-gray-50">
                   Pesan Tiket
               </a>
               <a href="#Galleri" class="block px-3 py-2 text-base font-medium text-gray-600 hover:text-gray-900 hover:bg-gray-50">
                   Galleri
               </a>
               <a href="#CaraMemesan" class="block px-3 py-2 text-base font-medium text-gray-600 hover:text-gray-900 hover:bg-gray-50">
                   Cara Memesan
               </a>
               <a href="#TentangKami" class="block px-3 py-2 text-base font-medium text-gray-600 hover:text-gray-900 hover:bg-gray-50">
                   Kontak Kami
               </a>

               @auth
               <div class="border-t border-gray-200 pt-4">
                   <div class="px-3 py-2">
                       <p class="text-base font-medium text-gray-800">{{ Auth::user()->name }}</p>
                   </div>
                   <a href="{{ route('pemesanan.create') }}" class="block px-3 py-2 text-base font-medium text-gray-600 hover:text-gray-900 hover:bg-gray-50">
                       Pesan Sekarang
                   </a>
                   <a href="{{ route('pemesanan.my-tickets') }}" class="block px-3 py-2 text-base font-medium text-gray-600 hover:text-gray-900 hover:bg-gray-50">
                       Tiket Saya
                   </a>
                   <form method="POST" action="{{ route('logout') }}">
                       @csrf
                       <button type="submit" class="block w-full text-left px-3 py-2 text-base font-medium text-gray-600 hover:text-gray-900 hover:bg-gray-50">
                           Logout
                       </button>
                   </form>
               </div>
               @endauth
           </div>
       </div>
   </nav>

   <!-- Content dengan padding top untuk navbar -->
   <main class="pt-16"> <!-- Tambahkan pt-16 untuk memberikan ruang di bawah navbar -->
       <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
           @yield('content')
       </div>
   </main>

   <!-- Footer -->
   <footer class="bg-white mt-auto">
       <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
           <p class="text-center text-gray-600">
               © {{ date('Y') }} Hutan Pinusan Kalilo. Created by 
               <a href="https://github.com/GalyleoIlhamSetyaka" class="text-blue-600 hover:underline">
                   Ilham Setyaka
               </a>
           </p>
       </div>
   </footer>

   @stack('scripts')
</body>
</html>