<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    protected $fillable = ['user_id', 'description', 'status'];

    public function staff()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function user()
    {
    return $this->belongsTo(User::class);
    }
}
