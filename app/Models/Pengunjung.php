<?php

namespace app\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Pengunjung extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $table = 'pengunjung';

    protected $fillable = [
        'name',
        'email',
        'phone',
        'password',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    public function pemesanan()
    {
        return $this->hasMany(Pemesanan::class, 'visitor_id');
    }
}