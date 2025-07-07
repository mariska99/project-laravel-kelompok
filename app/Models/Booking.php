<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{
    protected $fillable = [
        'customer_name',
        'phone_number',
        'booking_date',
        'wisata_id',
    ];

    public function wisata()
    {
        return $this->belongsTo(Wisata::class);
    }
}
