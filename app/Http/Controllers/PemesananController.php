<?php

namespace App\Http\Controllers;

use App\Models\Pemesanan;
use App\Models\Pengunjung;
use App\Models\TiketPaket;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;

class PemesananController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth']);
    }

    public function index()
    {
        $pemesanan = Pemesanan::with('pengunjung')->get();
        return view('index', compact('pemesanan'));
    }

    public function create()
    {
        $packages = TiketPaket::getPackages();
        return view('pemesanan.create', compact('packages'));
    }

    public function store(Request $request)
    {
        try {
            Log::info('Menerima data pemesanan:', $request->all());
            DB::beginTransaction();

            // Validate the request
            $validated = $request->validate([
                'name' => 'required|string|max:255',
                'email' => 'required|email|max:255',
                'phone' => 'required|string|max:255',
                'order_date' => 'required|date|after:today',
                'package' => 'required|integer|in:1,2,3',
                'proof_of_payment' => 'required|image|mimes:jpg,jpeg,png|max:2048'
            ]);

            // Upload bukti pembayaran
            $proofPath = $request->file('proof_of_payment')->store('proof-of-payment', 'public');
            Log::info('Bukti pembayaran diunggah:', ['path' => $proofPath]);

            // Create or find pengunjung
            $pengunjung = Pengunjung::firstOrCreate(
                ['email' => $validated['email']],
                [
                    'name' => $validated['name'],
                    'phone' => $validated['phone']
                ]
            );
            Log::info('Pengunjung dibuat/ditemukan:', $pengunjung->toArray());

            // Get package details
            $paket = TiketPaket::getPackageById($validated['package']);
            Log::info('Detail paket:', $paket);

            // Create pemesanan
            $orderCode = 'RSV-' . time();
            $pemesanan = Pemesanan::create([
                'order_code' => $orderCode,
                'order_date' => $validated['order_date'],
                'num_people' => $paket['num_people'],
                'price' => $paket['price'],
                'visitor_id' => $pengunjung->id,
                'proof_of_payment' => $proofPath
            ]);
            Log::info('Pemesanan dibuat:', $pemesanan->toArray());

            DB::commit();

            return redirect()
                ->route('pemesanan.create')
                ->with('success', 'Pemesanan berhasil dibuat! Kode pemesanan Anda: ' . $orderCode);
        } catch (\Exception $e) {
            DB::rollback();
            Log::error('Terjadi kesalahan saat membuat pemesanan:', [
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
        $pakets = TiketPaket::getPackages();
        return view('pemesanan.edit', compact('pemesanan', 'pakets'));
    }

    public function update(Request $request, $id)
    {
        // Validasi input
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'phone' => 'required|string|max:255',
            'order_date' => 'required|date|after:today',
            'package' => 'required|integer',
            'proof_of_payment' => 'sometimes|image|mimes:jpeg,png|max:2048'
        ]);

        $pemesanan = Pemesanan::findOrFail($id);
        $paket = TiketPaket::getPackageById($request->package);

        // Update pengunjung
        $pengunjung = Pengunjung::findOrFail($pemesanan->visitor_id);
        $pengunjung->update([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'phone' => $validated['phone']
        ]);
        Log::info('Updated visitor details:', $pengunjung->toArray());

        // Update bukti pembayaran jika ada
        if ($request->hasFile('proof_of_payment')) {
            // Hapus file lama jika ada
            if ($pemesanan->proof_of_payment) {
                Storage::disk('public')->delete($pemesanan->proof_of_payment);
            }

            // Upload file baru
            $buktiPath = $request->file('proof_of_payment')->store('bukti-pembayaran', 'public');
            $pemesanan->proof_of_payment = $buktiPath;
            Log::info('Uploaded new proof of payment:', ['path' => $buktiPath]);
        }

        // Update pemesanan
        $pemesanan->update([
            'order_date' => $validated['order_date'],
            'num_people' => $paket['num_people'],
            'price' => $paket['harga']
        ]);
        Log::info('Updated pemesanan details:', $pemesanan->toArray());

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
            Log::info('Deleted proof of payment file:', ['path' => $pemesanan->proof_of_payment]);
        }

        $pemesanan->delete();
        Log::info('Deleted pemesanan:', $pemesanan->toArray());

        return redirect()
            ->route('pemesanan.create')
            ->with('success', 'Pemesanan berhasil dihapus!');
    }
}