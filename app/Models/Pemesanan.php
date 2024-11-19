<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pemesanan extends Model
{
    use HasFactory;

    protected $table = 'pemesanan';
    
    protected $fillable = [
        'order_code',
        'order_date',
        'num_people',
        'price',
        'visitor_id',
        'proof_of_payment'
    ];

    protected $dates = [
        'order_date'
    ];
    public function pengunjung()
{
    return $this->belongsTo(Pengunjung::class, 'visitor_id');
}
}
