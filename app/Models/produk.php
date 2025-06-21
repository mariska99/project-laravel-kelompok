<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class produk extends Model
{
    protected $fillable = [
        'name',
        'lokasi',
        'description',
        'harga_tiket',
        'jam_buka',
        'jam_tutup',
        'gambar',
        'status'
    ];
}
