<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Medical_history extends Model
{
    use HasFactory;
    protected $fillable = [
        'patient_id',
        'bookappointment_id',
        'blood_type',
        'asmathic',
        'major_illness',
        'allergic_to_any_drug',
        'list_of_current_medic',
        'care_giver_name',
        'care_giver_phone',
        'health_status',
         'comment',
    ];
}
