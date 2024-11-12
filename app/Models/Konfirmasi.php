<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Konfirmasi extends Model
{
    use HasFactory;

    protected $table = 'konfirmasi';
    protected $fillable = ['order_id', 'amount', 'proof_of_transfer'];

    public function pemesanan()
    {
        return $this->belongsTo(Pemesanan::class, 'order_id');
    }
}
