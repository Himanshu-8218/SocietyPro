<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Visitor extends Model
{
    use HasFactory;

    protected $fillable = [
        'name', 'contact', 'purpose', 'status', 'resident_id', 'approved_by','date'
    ];

    public function resident()
    {
        return $this->belongsTo(User::class, 'resident_id');
    }

    public function approver()
    {
        return $this->belongsTo(User::class, 'approved_by');
    }
}

