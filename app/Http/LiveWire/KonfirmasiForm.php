<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Livewire\WithFileUploads;
use App\Models\Konfirmasi;
use App\Models\Pemesanan;
use Illuminate\Support\Facades\Storage;

class KonfirmasiForm extends Component
{
    use WithFileUploads;

    public $kode_pemesanan;
    public $bukti_transfer;
    public $preview_image;
    public $pemesanan_detail;

    protected $rules = [
        'kode_pemesanan' => 'required|exists:pemesanan,kode_pemesanan',
        'bukti_transfer' => 'required|image|max:2048' // max 2MB
    ];

    public function updatedKodePemesanan()
    {
        if ($this->kode_pemesanan) {
            $this->pemesanan_detail = Pemesanan::where('kode_pemesanan', $this->kode_pemesanan)->first();
        }
    }

    public function updatedBuktiTransfer()
    {
        $this->validate([
            'bukti_transfer' => 'image|max:2048',
        ]);

        // Create temporary URL for preview
        $this->preview_image = $this->bukti_transfer->temporaryUrl();
    }

    public function submit()
    {
        $this->validate();

        $pemesanan = Pemesanan::where('kode_pemesanan', $this->kode_pemesanan)->first();
        
        if(!$pemesanan) {
            session()->flash('error', 'Kode pemesanan tidak ditemukan');
            return;
        }

        // Save image
        $path = $this->bukti_transfer->store('bukti-transfer', 'public');

        Konfirmasi::create([
            'id_pemesanan' => $pemesanan->id_pemesanan,
            'kode_pemesanan' => $this->kode_pemesanan,
            'nama_pgj' => $pemesanan->nama_pgj,
            'nominal' => $pemesanan->harga,
            'jumlah_orang' => $pemesanan->jumlah_orang,
            'tanggal' => now(),
            'bukti_transfer' => $path
        ]);

        session()->flash('message', 'Konfirmasi pembayaran berhasil dikirim!');
        $this->reset(['kode_pemesanan', 'bukti_transfer', 'preview_image', 'pemesanan_detail']);
    }

    public function render()
    {
        return view('livewire.konfirmasi-form');
    }
}