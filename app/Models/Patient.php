<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Tymon\JWTAuth\Contracts\JWTSubject;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Notifications\Notifiable;
use App\Models\Bookappointment;
use App\Models\Medical_history;
use App\Models\Payment;




class Patient extends Authenticatable implements JWTSubject
{
    use HasApiTokens, HasFactory, Notifiable;
    protected $fillable = [
        'name',
        'email',
        'phone',
        'password'
    ];

    protected $appends =[
        'total_appointment',

    ];

    public function getTotalAppointmentAttribute(){
        return $this->bookappointment()->count();
    }

    public function bookappointment(){
        return $this->hasMany(Bookappointment::class);
    }

    public function patientpayments(){

        return $this->hasMany(Payment::class);
    }


    public function patient(){
        return $this->hasOne(Patient::class);
    }

 
    public function getJWTIdentifier()
    {
        return $this->getKey();
    }
    public function getJWTCustomClaims()
    {
        return [];
    }

}
