<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class StaffShift extends Model
{
    protected $fillable = ['user_id', 'shift', 'date'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
