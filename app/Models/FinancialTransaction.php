<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
class FinancialTransaction extends Model
{
    use HasFactory;

    protected $fillable = ['transaction_date', 'amount', 'source'];
    //
}
