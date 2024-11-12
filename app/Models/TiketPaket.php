<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TiketPaket 
{
    public static function getPakets()
    {
        return [
            [
                'id' => 1,
                'nama' => 'Paket Couple',
                'jumlah_orang' => 2,
                'harga' => 10000,
                'deskripsi' => 'Paket untuk 2 orang',
                'fitur' => [
                    'Tiket masuk untuk 2 orang',
                    'Parkir gratis',
                    'Foto di spot utama'
                ]
            ],
            [
                'id' => 2,
                'nama' => 'Paket Keluarga',
                'jumlah_orang' => 5,
                'harga' => 25000,
                'deskripsi' => 'Paket untuk 5 orang',
                'fitur' => [
                    'Tiket masuk untuk 5 orang',
                    'Parkir gratis',
                    'Foto di semua spot',
                    'Welcome drink'
                ]
            ],
            [
                'id' => 3,
                'nama' => 'Paket Rombongan',
                'jumlah_orang' => 10,
                'harga' => 100000,
                'deskripsi' => 'Paket untuk 10 orang',
                'fitur' => [
                    'Tiket masuk untuk 10 orang',
                    'Parkir gratis',
                    'Foto di semua spot',
                    'Welcome drink',
                    'Tour guide',
                    'Makan siang'
                ]
            ],
        ];
    }

    public static function getPaketById($id)
    {
        return collect(self::getPakets())->firstWhere('id', $id);
    }

}
