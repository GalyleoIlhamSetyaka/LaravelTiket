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
                'description' => 'Package for one person',
                'num_people' => 2,
                'price' => 10000,
                'image' => 'img/paket/HPK-1.png',
                'features' => [
                    'Entrance ticket for 2',
                ]
            ],
            2 => [
                'name' => 'Family Package',
                'description' => 'Package for family',
                'num_people' => 5,
                'price' => 25000,
                'image' => 'img/paket/HPK-2.png',
                'features' => [
                    'Entrance ticket for 5',
                ]
            ],
            3 => [
                'name' => 'Group Package',
                'description' => 'Package for groups',
                'num_people' => 10,
                'price' => 50000,
                'image' => 'img/paket/HPK-3.png',
                'features' => [
                    'Entrance ticket for 10',
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