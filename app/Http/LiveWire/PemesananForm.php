<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Pemesanan;
use App\Models\Pengunjung;
use App\Models\TiketPaket;

class PemesananForm extends Component
{
    public $nama_pgj;
    public $email_pgj;
    public $nomor_pgj;
    public $tanggal;
    public $selectedPaket = null;
    public $paketDetail = null;

    protected $rules = [
        'nama_pgj' => 'required',
        'email_pgj' => 'required|email',
        'nomor_pgj' => 'required',
        'tanggal' => 'required|date|after:today',
        'selectedPaket' => 'required'
    ];

    public function updatedSelectedPaket($value)
    {
        if ($value) {
            $this->paketDetail = TiketPaket::getPackageById($value);
        }
    }

    public function submit()
    {
        $this->validate();

        $paket = TiketPaket::getPackageById($this->selectedPaket);

        // Create or find pengunjung
        $pengunjung = Pengunjung::firstOrCreate(
            ['email_pgj' => $this->email_pgj],
            [
                'nama_pgj' => $this->nama_pgj,
                'nomor_pgj' => $this->nomor_pgj
            ]
        );

        // Create pemesanan
        $kode = 'RSV-' . time();

        Pemesanan::create([
            'kode_pemesanan' => $kode,
            'tanggal' => $this->tanggal,
            'nama_pgj' => $this->nama_pgj,
            'email_pgj' => $this->email_pgj,
            'nomor_pgj' => $this->nomor_pgj,
            'jumlah_orang' => $paket['jumlah_orang'],
            'harga' => $paket['price'],
            'id_pgj' => $pengunjung->id_pgj
        ]);

        session()->flash('message', 'Pemesanan berhasil dibuat! Kode pemesanan Anda: ' . $kode);
        $this->reset(['nama_pgj', 'email_pgj', 'nomor_pgj', 'tanggal', 'selectedPaket', 'paketDetail']);
    }

    public function render()
    {
        return view('livewire.pemesanan-form', [
            'pakets' => TiketPaket::getPakets()
        ]);
    }
}