<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\Models\User;
use App\Models\Bookappointment;
use App\Models\Patient;
use App\Models\Paymentrate;
use App\Models\Doctordecline;





class AdminController extends Controller
{
    public function doctorInformation(Request $request){
        $doctorpatient = DB::table('users')
        ->join('specializations','specializations.id','users.spec_id')
        ->join('paymentrates','paymentrates.id','paymentrates.user_id')
        ->select('users.id','users.firstname','users.lastname','paymentrates.totalearning','users.lastname','users.email','users.university','users.yearofgraduation','users.certificate','users.yearofcollection','users.liencence','specializations.name','users.status','users.appointment_channel','users.created_at')
        ->get();

        return response()->json([
            'user'=>$doctorpatient,
        ], 201);
    }

    public function allPatient(){

$patients = Patient::with('bookappointment')
->get();

return response()->json([
'patients'=>$patients,
]); 
    }

    public function teleMedicine(){

        $booktele =  Bookappointment::select('patients.name','patients.phone','patients.email as patient_email','payments.amount','bookappointments.start_time','bookappointments.end_time','bookappointments.date','bookappointments.reschedule_comment','bookappointments.status','bookappointments.new_date as new_doctor_date','bookappointments.new_time as new_doctor_time', 'users.firstname as doctor_firstname','users.lastname as doctor_lastname','users.email as user_email')
        ->join('patients','patients.id', 'bookappointments.patient_id')
        ->join('users','users.id', 'bookappointments.user_id')
        ->join('paymentrates','paymentrates.user_id', 'bookappointments.user_id')
        ->join('payments','payments.id', 'bookappointments.payment_id')
       ->get();

// $patientappoint = Bookappointment::select('id','patient_id','date','start_time','end_time','comment')
// ->with('patient')
// ->where('patient_id', $request->patient_id)
// ->get();

return response()->json([
'Telemedicine'=>$booktele,
]); 

    }

    public function getTransaction(){
        $trans = DB::table('paymentrates')
        ->join('users','users.id', 'paymentrates.user_id')
        ->select('users.firstname','users.lastname','paymentrates.totalearning','paymentrates.expected_payout','paymentrates.status','paymentrates.date')
        ->get();

        return response()->json([
            'Telemedicine'=>$trans,
            ]); 
    }

    public function approveTransaction($id){

        $approve = Paymentrate::find($id);
        $approve->status ='Paid';
        $approve->save();

        return response()->json([
            'message'=>'Payment approved Successfully',
        ]); 

    }

    public function approveDoctor($id){

        $approve = User::find($id);
        $approve->status ='Active';
        $approve->save();

        return response()->json([
            'message'=>'Doctor approved Successfully',
        ]); 

    }
    public function declineDoctor(Request $request ,$id){

        $user = User::find($request->user_id);
        $decline = new Doctordecline();
        $decline->user_id = $user->id;
        $decline->comment = $request->comment;
        $decline->save();


        $approve = User::find($id);
        $approve->status ='Declined';
        $approve->save();

        return response()->json([
            'message'=>'Sorry your Account was not Successfully',
        ]); 

    }

    public function patientBookedAppointments(Request $request){

        $patientAppointment = Bookappointment::select('patients.name','patients.phone','patients.email as patient_email','bookappointments.start_time','bookappointments.end_time','bookappointments.date','bookappointments.reschedule_comment','bookappointments.status','bookappointments.new_date as new_doctor_date','bookappointments.new_time as new_doctor_time', 'users.firstname as doctor_firstname','users.lastname as doctor_lastname','users.email as user_email')
        ->join('users','users.id', 'bookappointments.user_id')
        ->join('patients','patients.id', 'bookappointments.patient_id')
        ->where('patient_id', $request->patient_id)
        ->get();

        return response()->json([
            'Patient Appointment'=> $patientAppointment,
        ]); 
    }
}
