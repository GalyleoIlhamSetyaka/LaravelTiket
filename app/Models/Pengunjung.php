<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pengunjung extends Model
{
    use HasFactory;

    protected $table = 'pengunjung';
    protected $fillable = ['name', 'email', 'phone'];

    public function pemesanan()
    {
        return $this->hasMany(Pemesanan::class, 'visitor_id');
    }
}

