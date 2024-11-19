<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TiketPaket extends Model
{
    protected $table = 'tiket_pakets';

    public static function getPackages()
    {
        return config('tiket-paket.packages');
    }

    public static function getPackageById($id)
    {
        $packages = self::getPackages();
        return $packages[$id] ?? null;
    }
}