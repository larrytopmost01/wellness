<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use App\Models\Paymentrate;


class Payment extends Model
{
    use HasFactory;

    protected $fillable = [
        'patient_id',
        'paymentrate_id',
        'user_id',
        'date',
        'currency',
        'amount',
        'email',
        'status',
        'ref',
    ];

    public function user(){
        return $this->belongsTo(User::class);
    }
    

    public function paymentrate(){
        return $this->belongsTo(Paymentrate::class);
    }

    public function patient(){

        return $this->belongsTo(Patient::class);
    }

    public function users(){

        return $this->belongsToMany(User::class);
    }
}

