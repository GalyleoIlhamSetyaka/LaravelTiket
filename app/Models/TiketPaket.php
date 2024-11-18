<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TiketPaket extends Model
{
    public static function getPackages()
    {
        return [
            1 => [
                'name' => 'Basic Package',
                'description' => 'PAKET 1',
                'num_people' => 2,
                'price' => 10000,
                'image' => 'img/paket/HPK-1.png',
                'features' => [
                    'Tiket masuk untuk 2 orang',
                ]
            ],
            2 => [
                'name' => 'Family Package',
                'description' => 'PAKET 2',
                'num_people' => 5,
                'price' => 25000,
                'image' => 'img/paket/HPK-2.png',
                'features' => [
                    'Tiket masuk untuk 5 orang',
                ]
            ],
            3 => [
                'name' => 'Group Package',
                'description' => 'PAKET 3',
                'num_people' => 10,
                'price' => 50000,
                'image' => 'img/paket/HPK-3.png',
                'features' => [
                    'Tiket masuk untuk 10 orang',
                ]
            ]
        ];
    }

    public static function getPackageById($id)
    {
        $packages = self::getPackages();
        return $packages[$id] ?? null;
    }
}