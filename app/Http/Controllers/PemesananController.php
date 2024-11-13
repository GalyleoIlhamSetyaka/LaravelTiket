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
        $pakets = TiketPaket::getPakets();
        return view('pemesanan.create', compact('pakets'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama_pgj' => 'required',
            'email_pgj' => 'required|email',
            'nomor_pgj' => 'required',
            'tanggal' => 'required|date|after:today',
            'paket' => 'required'
        ]);

        $paket = TiketPaket::getPaketById($request->paket);

        // Create or find pengunjung
        $pengunjung = Pengunjung::firstOrCreate(
            ['email_pgj' => $validated['email_pgj']],
            [
                'nama_pgj' => $validated['nama_pgj'],
                'nomor_pgj' => $validated['nomor_pgj']
            ]
        );

        // Create pemesanan
        $kode = 'RSV-' . time();

        Pemesanan::create([
            'kode_pemesanan' => $kode,
            'tanggal' => $validated['tanggal'],
            'nama_pgj' => $validated['nama_pgj'],
            'email_pgj' => $validated['email_pgj'],
            'nomor_pgj' => $validated['nomor_pgj'],
            'jumlah_orang' => $paket['jumlah_orang'],
            'harga' => $paket['harga'],
            'id_pgj' => $pengunjung->id_pgj
        ]);

        return redirect()
            ->route('pemesanan.create')
            ->with('success', 'Pemesanan berhasil dibuat! Kode pemesanan Anda: ' . $kode);
    }
}