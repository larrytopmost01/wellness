<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use App\Models\Bankdetail;

class Doctorpayment extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_id',
        'bankdetail_id',
        'transactionid',
        'amount',
        'transaction_type',
        'recepient',
        'sender',
        'date',
        'transaction_status'
    ];


    public function bankdetail(){
        return $this->hasOne(Bankdetail::class);
    }
    public function user(){

        return $this->hasOne(User::class);
    
        }
}
