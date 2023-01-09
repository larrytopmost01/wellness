<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Bankdetail extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_id',
        'doctorpayment_id',
        'bank_id',
        'account_number',
        'account_name'
    ];

}
