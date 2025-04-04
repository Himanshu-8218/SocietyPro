<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Bill extends Model
{
    protected $fillable = ['resident_id', 'amount', 'due_date', 'status', 'transaction_id'];

    public function resident()
    {
        return $this->belongsTo(User::class);
    }
}
