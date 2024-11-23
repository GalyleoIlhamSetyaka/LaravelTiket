<!-- resources/views/pemesanan/my-tickets.blade.php -->
@extends('layouts.app')

@section('content')
<div class="min-h-screen bg-gray-50 py-8">
   <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
       <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
           <div class="p-6">
               <h2 class="text-3xl font-bold text-gray-900 mb-8">Tiket Saya</h2>

               <div class="space-y-6">
                   @forelse ($tickets as $ticket)
                       <div class="bg-white border rounded-lg shadow-sm overflow-hidden">
                           <div class="p-6">
                               <!-- Header -->
                               <div class="flex items-center justify-between mb-4">
                                   <h3 class="text-xl font-semibold text-gray-900">
                                       Kode: {{ $ticket->order_code }}
                                   </h3>
                                   <!-- Status Badge -->
                                   @if($ticket->status == 'pending')
                                       <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-yellow-100 text-yellow-800">
                                           Menunggu Konfirmasi
                                       </span>
                                   @else
                                       <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-green-100 text-green-800">
                                           Dikonfirmasi
                                       </span>
                                   @endif
                               </div>

                               <!-- Ticket Details -->
                               <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                    <div class="mb-4">
                                        <p class="text-sm font-medium text-gray-500">Nama Pengunjung</p>
                                        <p class="mt-1 text-lg text-gray-900">{{ $ticket->pengunjung->name }}</p>
                                    </div>

                                    <div>
                                        <p class="text-sm font-medium text-gray-500">Tanggal Kunjungan</p>
                                        <p class="mt-1 text-lg text-gray-900">
                                            {{ \Carbon\Carbon::parse($ticket->order_date)->format('d F Y') }}
                                        </p>
                                    </div>

                                    <div>
                                        <p class="text-sm font-medium text-gray-500">Jumlah Orang</p>
                                        <p class="mt-1 text-lg text-gray-900">{{ $ticket->num_people }} orang</p>
                                    </div>

                                    <div>
                                        <p class="text-sm font-medium text-gray-500">Total Harga</p>
                                        <p class="mt-1 text-lg text-gray-900">Rp {{ number_format($ticket->price, 0, ',', '.') }}</p>
                                    </div>
                                   </div>

                                   <!-- Bukti Pembayaran -->
                                   @if($ticket->proof_of_payment)
                                       <div>
                                           <p class="text-sm font-medium text-gray-500 mb-2">Bukti Pembayaran</p>
                                           <img src="{{ Storage::disk('public')->url($ticket->proof_of_payment) }}" 
                                               alt="Bukti Pembayaran" 
                                               class="w-full max-w-xs rounded-lg shadow-sm">
                                       </div>
                                   @endif
                               </div>

                               <!-- Actions -->
                               <div class="mt-6 pt-6 border-t border-gray-200 flex justify-end space-x-3">
                                   @if($ticket->status == 'confirmed')
                                       <a href="{{ route('pemesanan.download-ticket', $ticket->id) }}" 
                                       class="inline-flex items-center px-4 py-2 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                                           <svg class="h-4 w-4 mr-2" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                               <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4" />
                                           </svg>
                                           Download Tiket
                                       </a>
                                   @endif
                                   
                                   @if($ticket->status == 'pending')
                                       <form action="{{ route('pemesanan.cancel', $ticket->id) }}" method="POST" 
                                           onsubmit="return confirm('Apakah Anda yakin ingin membatalkan pesanan ini?')">
                                           @csrf
                                           @method('DELETE')
                                           <button type="submit" 
                                               class="inline-flex items-center px-4 py-2 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-red-600 hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500">
                                               <svg class="h-4 w-4 mr-2" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                   <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                               </svg>
                                               Batalkan
                                           </button>
                                       </form>
                                   @endif
                               </div>
                           </div>
                       </div>
                   @empty
                       <div class="text-center py-12">
                           <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                               <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2" />
                           </svg>
                           <h3 class="mt-2 text-sm font-medium text-gray-900">Belum ada tiket</h3>
                           <p class="mt-1 text-sm text-gray-500">Mulai dengan memesan tiket pertama Anda.</p>
                           <div class="mt-6">
                               <a href="{{ route('pemesanan.create') }}" 
                                   class="inline-flex items-center px-4 py-2 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                                   <svg class="h-4 w-4 mr-2" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                       <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                                   </svg>
                                   Pesan Tiket
                               </a>
                           </div>
                       </div>
                   @endforelse
               </div>
           </div>
       </div>
   </div>
</div>
@endsection