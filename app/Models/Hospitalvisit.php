<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Hospitalvisit extends Model
{
    use HasFactory;
    protected $fillable = [
        'patient_id',
        'hospital',
        'doctor_name',
        'appoint_date',
        'appoint_time',
    ];
}
