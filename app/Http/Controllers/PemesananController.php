<?php

namespace App\Http\Controllers;

use App\Models\Pemesanan;
use App\Models\Pengunjung; 
use App\Models\TiketPaket;
use Illuminate\Http\Request;

class PemesananController extends Controller
{
   public function index()
   {
       return view('pemesanan.index');
   }

    public function create()
    {
        $packages = TiketPaket::getPackages();
        return view('pemesanan.create', compact('packages'));
    }

// app/Http/Controllers/PemesananController.php

    public function store(Request $request)
    {
        try {
            // Debug received data
            \Log::info('Received Data:', $request->all());

            // Validate the request
            $validated = $request->validate([
                'name' => 'required|string|max:255',
                'email' => 'required|email|max:255',
                'phone' => 'required|string|max:255',
                'order_date' => 'required|date|after:today',
                'num_people' => 'required|integer|min:1',
                'price' => 'required|numeric|min:0',
                'proof_of_payment' => 'required|image|mimes:jpg,jpeg,png|max:2048'
            ]);

            \DB::beginTransaction();

            // Upload bukti pembayaran
            $proofPath = $request->file('proof_of_payment')->store('proof-of-payment', 'public');
            \Log::info('File uploaded:', ['path' => $proofPath]);

            // Create or find pengunjung
            $pengunjung = Pengunjung::firstOrCreate(
                ['email' => $validated['email']],
                [
                    'name' => $validated['name'],
                    'phone' => $validated['phone']
                ]
            );
            \Log::info('Pengunjung created/found:', $pengunjung->toArray());

            // Create pemesanan
            $orderCode = 'RSV-' . time();
            $pemesanan = Pemesanan::create([
                'order_code' => $orderCode,
                'order_date' => $validated['order_date'],
                'num_people' => $validated['num_people'],
                'price' => $validated['price'],
                'visitor_id' => $pengunjung->id,
                'proof_of_payment' => $proofPath
            ]);
            \Log::info('Pemesanan created:', $pemesanan->toArray());

            \DB::commit();

            return redirect()
                ->route('pemesanan.create')
                ->with('success', 'Pemesanan berhasil dibuat! Kode pemesanan Anda: ' . $orderCode);

        } catch (\Exception $e) {
            \DB::rollback();
            \Log::error('Error creating pemesanan:', [
                'message' => $e->getMessage(),
                'trace' => $e->getTraceAsString()
            ]);

            return back()
                ->withInput()
                ->withErrors(['error' => 'Terjadi kesalahan: ' . $e->getMessage()]);
        }
    }
   public function show($id)
   {
       $pemesanan = Pemesanan::with('pengunjung')->findOrFail($id);
       return view('pemesanan.show', compact('pemesanan'));
   }

   public function edit($id)
   {
       $pemesanan = Pemesanan::with('pengunjung')->findOrFail($id);
       $pakets = TiketPaket::getPakets();
       return view('pemesanan.edit', compact('pemesanan', 'pakets'));
   }

   public function update(Request $request, $id)
   {
       // Validasi input
       $validated = $request->validate([
           'nama_pgj' => 'required',
           'email_pgj' => 'required|email',
           'nomor_pgj' => 'required',
           'order_date' => 'required|date|after:today',
           'paket' => 'required',
           'proof_of_payment' => 'sometimes|image|mimes:jpeg,png|max:2048'
       ]);

       $pemesanan = Pemesanan::findOrFail($id);
       $paket = TiketPaket::getPaketById($request->paket);

       // Update pengunjung
       $pengunjung = Pengunjung::findOrFail($pemesanan->visitor_id);
       $pengunjung->update([
           'nama_pgj' => $validated['nama_pgj'],
           'email_pgj' => $validated['email_pgj'],
           'nomor_pgj' => $validated['nomor_pgj']
       ]);

       // Update bukti pembayaran jika ada
       if ($request->hasFile('proof_of_payment')) {
           // Hapus file lama jika ada
           if ($pemesanan->proof_of_payment) {
               Storage::disk('public')->delete($pemesanan->proof_of_payment);
           }
           
           // Upload file baru
           $buktiPath = $request->file('proof_of_payment')->store('bukti-pembayaran', 'public');
           $pemesanan->proof_of_payment = $buktiPath;
       }

       // Update pemesanan
       $pemesanan->update([
           'order_date' => $validated['order_date'],
           'num_people' => $paket['jumlah_orang'],
           'price' => $paket['harga']
       ]);

       return redirect()
           ->route('pemesanan.show', $pemesanan->id)
           ->with('success', 'Pemesanan berhasil diperbarui!');
   }

   public function destroy($id)
   {
       $pemesanan = Pemesanan::findOrFail($id);
       
       // Hapus file bukti pembayaran jika ada
       if ($pemesanan->proof_of_payment) {
           Storage::disk('public')->delete($pemesanan->proof_of_payment);
       }

       $pemesanan->delete();

       return redirect()
           ->route('pemesanan.index')
           ->with('success', 'Pemesanan berhasil dihapus!');
   }
}