<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{
    protected $fillable = [
        'user_id',
        'facility_id',
        'start_time',
        'end_time',
        'date'
    ];

    public function facility()
    {
        return $this->belongsTo(Facility::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
