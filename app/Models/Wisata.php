<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Wisata extends Model
{
    protected $fillable = [
        'lokasi',
        'description',
        'harga_tiket',
        'jam_buka',
        'jam_tutup',
        'gambar',
    ];

    public function bookings()
    {
        return $this->hasMany(Booking::class);
    }
}
