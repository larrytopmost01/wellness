<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Patient;

class doctorreport extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_id',
        'patient_id',
        'comment',
    ];

    public function patient(){
        return $this->belongsTo(Patient::class);
    }
    public function user(){
        return $this->belongsTo(User::class);
    }
}
