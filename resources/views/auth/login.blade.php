@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4 py-8">
   <div class="max-w-md mx-auto bg-white rounded-lg shadow-md overflow-hidden">
       <div class="px-6 py-4">
           <h2 class="text-2xl font-bold text-center mb-6">Login</h2>

           @if(session('error'))
               <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-4">
                   {{ session('error') }}
               </div>
           @endif

           <form method="POST" action="{{ route('login') }}" class="space-y-4">
               @csrf

               <div>
                   <label for="email" class="block text-sm font-medium text-gray-700">Email</label>
                   <input type="email" name="email" id="email" value="{{ old('email') }}"
                       class="mt-1 block w-full rounded-md border-gray-300 shadow-sm 
                       focus:border-blue-500 focus:ring-blue-500">
                   @error('email')
                       <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                   @enderror
               </div>

               <div>
                   <label for="password" class="block text-sm font-medium text-gray-700">Password</label>
                   <input type="password" name="password" id="password"
                       class="mt-1 block w-full rounded-md border-gray-300 shadow-sm 
                       focus:border-blue-500 focus:ring-blue-500">
                   @error('password')
                       <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                   @enderror
               </div>

               <div class="flex items-center">
                   <input type="checkbox" name="remember" id="remember"
                       class="h-4 w-4 text-blue-600 focus:ring-blue-500 border-gray-300 rounded">
                   <label for="remember" class="ml-2 block text-sm text-gray-700">
                       Ingat Saya
                   </label>
               </div>

               <div class="flex items-center justify-between">
                   <button type="submit"
                       class="bg-blue-600 text-white px-4 py-2 rounded-md hover:bg-blue-700 
                       focus:outline-none focus:ring-2 focus:ring-blue-500">
                       Login
                   </button>
                   <div class="text-sm">
                       <a href="{{ route('register') }}" class="text-blue-600 hover:underline">
                           Belum punya akun?
                       </a>
                       <br>
                       <a href="{{ route('password.request') }}" class="text-blue-600 hover:underline">
                           Lupa password?
                       </a>
                   </div>
               </div>
           </form>
       </div>
   </div>
</div>
@endsection