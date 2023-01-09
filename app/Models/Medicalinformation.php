<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Medicalinformation extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_id',
        'bookappointment_id',        
        'year_of_experience',
        'comment',
        'workmedium',
    ];
}
