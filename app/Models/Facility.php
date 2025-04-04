<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Facility extends Model
{
    protected $fillable = [
        'name',
        'total_slots',
    ];

    public function bookings()
    {
        return $this->hasMany(Booking::class);
    }
}
