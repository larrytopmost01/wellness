<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Tymon\JWTAuth\Contracts\JWTSubject;
use App\Models\Medicalinformation;
use App\Models\Paymentrate;
use App\Models\Time;
use App\Models\Bookappointment;
use App\Models\Payment;
use App\Models\Specialization;




class User extends Authenticatable implements JWTSubject
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'firstname',
        'lastname',
        'email',
        'phone',
        'password',
        'spec_id',
        'doctorpayment_id',
        'university',
        'yearofgraduation',
        'certificate',
        'yearofcollection',
        'liencence',
        'commonhealthissue_id',
        'status',
        'appoint_status'


    ];

    protected $appends = [
        'doctor_patient_payment',

    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    
    public function getDoctorPatientPaymentAttribute(){
        return $this->payments()->sum('amount');
    }

    public function payments(){
        return $this->hasMany(Payment::class)->with('patient');
    }

    public function getJWTIdentifier()
    {
        return $this->getKey();
    }

    public function getJWTCustomClaims()
    {
        return [];
    }

    public function medicalinformation(){

    return $this->hasOne(Medicalinformation::class);

    }

    public function paymentrate(){
        return $this->hasOne(Paymentrate::class);
    }

    public function times(){

        return $this->hasMany(Time::class);
    }

    public function bookappointment(){
        return $this->hasOne(Bookappointment::class);
    }

    public function payment(){
        return $this->hasOne(Payment::class);
    }

    public function specialization(){
        return $this->belongsTo(Specialization::class);
    }



}
