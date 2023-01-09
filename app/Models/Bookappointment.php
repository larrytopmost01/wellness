<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Patient;
use App\Models\Medical_history;
use App\Models\User;
use App\Models\Medicalinformation;
use App\Models\Commonhealthissue;
use Carbon\Carbon;





class Bookappointment extends Model
{
    use HasFactory;
    protected $fillable = [
        'patient_id',
        'commonhealthissue_id',
        'user_id',
        'date',
        'start_time',
        'end_time',
        'comment',
    ];

    protected $appends = ['duration'];

    public function getDurationAttribute()
    {
        $startTime = Carbon::parse($this->start_time);
        $endTime = Carbon::parse($this->end_time);
        return $endTime->diffInHours($startTime);
    }

    public function patient(){
        return $this->belongsTo(Patient::class);
    }

    public function medicalhistory(){
        return $this->hasOne(Medical_history::class);
    }
    public function user(){
        return $this->hasOne(User::class);
    }
    public function medicalinformation(){
        return $this->hasOne(Medicalinformation::class);
    }
    public function commonhealthissue (){
        return $this->belongsTo(Commonhealthissue ::class);
    }
}

