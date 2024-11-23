<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

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
        'proof_of_payment',
        'status',
    ];

    protected $dates = [
        'order_date'
    ];
    public function pengunjung()
{
    return $this->belongsTo(Pengunjung::class, 'visitor_id');
}
    public function getProofOfPaymentUrlAttribute()
    {
        return $this->proof_of_payment ? Storage::disk('public')->url($this->proof_of_payment) : null;
    }

}
