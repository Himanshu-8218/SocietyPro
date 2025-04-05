<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Unit extends Model
{
    protected $fillable = ['floor_id', 'unit_number', 'status', 'resident_id'];

    public function floor()
    {
        return $this->belongsTo(Floor::class);
    }

    public function resident()
    {
        return $this->belongsTo(User::class, 'resident_id');
    }
}
