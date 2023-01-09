<?php

namespace App\Http\Controllers;

use Validator;


use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Models\Medical_profile;
use App\Models\Patient;
use App\Models\Medical_history;
use App\Models\Time;
use App\Models\Bookappointment;
use App\Models\User;
use Tymon\JWTAuth\Exceptions\JWTException;
use JWTAuth;
use App\Models\Medicalinformation;
use App\Models\Paymentrate;
use App\Models\Specialization;
use App\Models\Hospitalvisit;
use App\Models\Commonhealthissue;
use App\Models\Payment;
use App\Models\Instanceservice;

class PatientController extends Controller
{
    public function _construct(){
        $this->middleware('auth:api',['except'=>['login', 'register']]);
    }

    
    public function register(Request $request){
                $validator =Validator::make($request->all(),[
                    'name'=>'required',
                    'phone'=> 'required',
                    'email'=> 'required',
                
                ]);

                if($validator->fails()){
                    return response()->json($validator->errors()->toJson(), 400);
    }

		$patient = new Patient();
		$patient->name = $request->name;
		$patient->phone = $request->phone;
		$patient->email = $request->email;
        $patient->password = bcrypt($request->password);
       	$patient->save();

        return response()->json([
            'message'=>'patient succesfully registerd',
            'user'=>$patient,
        ], 201);
    }

    public function login(Request $request){

        $patient = Patient::where('email', $request->email)->first();
        if(!$patient){
            return response()->json(
                [   'success' => false,
                    'message' => 'Patient not found with that email',
                ], 
                404);

            }
            $payload = null;
            $credentials = $request->only('email', 'password');
             if (!$token = JWTAuth::attempt($credentials)) {
                $payload = [
                    'success' => false,
                    'message' => 'Login failed, invalid credentials',
                ];
                return response()->json($payload, 201);
             }
             $payload = [
                'success'     => true,
                'message'     => 'Login was successful',
                'data' => [
                    'token_type'       => 'token',
                    'token'      => 'Bearer' . ' ' . $token,
                ]
            ];
            return response()->json($payload, Response::HTTP_OK);

    }
    


    public function medicalhistory(Request $request){

        $validator =Validator::make($request->all(),[
            'blood_type'=>'required',
            'asmathic'=>'required',
            'diabetic_history'=> 'required',
            'major_illness'=> 'required',
            'allergic_to_any_drug'=> 'required',
            'list_of_current_medic'=> 'required',
            'health_status'=> 'required',
        
        ]);

        if($validator->fails()){
            return response()->json($validator->errors()->toJson(), 400);
}
       
   
        $patient = Patient::find($request->patient_id);
        $history = new Medical_history();
        $history->patient_id = $patient->id;
        $history->blood_type = $request->blood_type;
		$history->asmathic =  $request->asmathic;
        $history->diabetic_history =  $request->diabetic_history;
        $history->major_illness =  $request->major_illness;
        $history->allergic_to_any_drug = $request->allergic_to_any_drug;
        $history->list_of_current_medic =  $request->list_of_current_medic;
		$history->care_giver_name = $request->care_giver_name;
        $history->care_giver_phone = $request->care_giver_phone;
        $history->health_status =  $request->health_status;
        $history->comment =  $request->comment;
		$history->save();

        return response()->json([
            'message'=>'Your Medical History Created  succesfully',
            'user'=>$history,
        ], 201);

    }

    public function doctorTime(){

        $time = Time::all();
        return response()->json([
            'time'=>$time,
        ]);
    }

    public function specialization(){

        $specialist = Specialization::all();
        return response()->json([
            'Specialist'=>$specialist,
        ]);
    }

    public function apointment(Request $request){
        $validator =Validator::make($request->all(),[
            'date'=>'required',    
            'start_time'=>'required',    
            'end_time'=>'required',    
        ]);

        if($validator->fails()){
            return response()->json($validator->errors()->toJson(), 400);
        }
        $payment = new Payment();
        $payment->user_id = $request->user_id;
        $payment->patient_id = $request->patient_id;
        $payment->amount = $request->amount;
        $payment->email = $request->email;
        $payment->date = $request->date;
        $payment->currency = $request->currency;
        $payment->ref = $request->ref;
        $payment->status = $request->status;
        $payment->save();



        $book = new Bookappointment();
        $book->user_id = $request->user_id;
        $book->payment_id = $payment->id;
        $book->patient_id = $request->patient_id;
        $book->date = $request->date;
        $book->start_time = $request->start_time;
        $book->end_time = $request->end_time;
        $book->comment = $request->comment;
        $book->status = 'Pending';

		$book->save();

        return response()->json([
            'message'=>'You have succesfully book  succesfully',
            'user'=>$book,
        ], 201);

    }

    public function searchappointment(Request $request){
        $appointment = Bookappointment::where('user_id', $request->user_id)
        ->where('date', $request->date)
        ->where('start_time', '>=', $request->start_time)
        ->where('end_time', '<=', $request->end_time)->first();
        
        if($appointment){
            $appointments = Bookappointment::where('user_id', $request->user_id)
            ->where('date', $request->date)->get();
            return response()->json([
                'message'=> 'Doctor not available for this time and date please choose another date and time',
                'doctors_schedule'=>  $appointments 
            ]);
        }
    }

    public function hospitalvisit(Request $request){
        $validator =Validator::make($request->all(),[
            'hospital'=>'required',    
            'doctor_name'=>'required',    
            'appoint_date'=>'required',    
            'appoint_time'=>'required',    

        ]);

        if($validator->fails()){
            return response()->json($validator->errors()->toJson(), 400);
        }
        $tim = Time::find($request->appoint_time);
        $patient = Patient::find($request->patient_id);
        $hospital = new Hospitalvisit();
        $hospital->patient_id = $patient->id;
        $hospital->hospital = $request->hospital;
        $hospital->doctor_name = $request->doctor_name;
        $hospital->appoint_time = $tim->id;
        $hospital->appoint_date = $request->appoint_date;
		$hospital->save();

        return response()->json([
            'message'=>'You have succesfully book  hospital appointment',
            'user'=>$hospital,
        ], 201);

    }


    public function doctorprofiles(){

        $doctors = User::select('id','firstname','lastname')
        ->with(['medicalinformation','paymentrate','times'])
        ->get();
        return response()->json([
            'users'=>$doctors,
        ]);

    }

    public function getDoctorProfilesbyId(Request $request){

        $doctor  = User::select('id','firstname','lastname')
        ->with(['medicalinformation','paymentrate' ,'times'])
        ->where('id', $request->user_id)
        ->get();
        return response()->json([
            'users'=>$doctor,
        ]);

    }


    public function specializationUsers(Request $request){
        $doctors = User::select('id','spec_id','firstname','lastname')
        ->with(['medicalinformation','paymentrate','times'])
        ->where('spec_id', $request->spec_id)
        ->get();

        return response()->json([
            'users'=>$doctors,
        ]); 
    }

    public function commonHealthIssueUser(Request $request){
        $commonhealthissue = User::select('id','commonhealthissue_id','firstname','lastname')
        ->with(['medicalinformation','paymentrate','times'])
        ->where('commonhealthissue_id', $request->commonhealthissue_id)
        ->get();

        return response()->json([
            'users'=>$commonhealthissue,
        ]); 


        }

    public function instanceservice(Request $request){
   
        $validator =Validator::make($request->all(),[
            'healthissue'=>'required',    
            'phone'=>'required',      

        ]);

        $payment = new Payment();
        $payment->patient_id = JWTAuth::Patient->id;
        $payment->amount = $request->amount;
        $payment->email = $request->email;
        $payment->date = $request->date;
        $payment->currency = $request->currency;
        $payment->ref = $request->ref;
        $payment->status = $request->status;
        $payment->save();

        $health_issue = Commonhealthissue::find($request->healthissue_id);
        $instance = new Instanceservice();
        $instance->patient_id =  JWTAuth::Patient->id;;
        $instance->payment_id = $payment->id;
        $instance->healthissue_id = $health_issue->id;
        $instance->phone = $request->phone;
		$instance->save();

        
    return response()->json([
        'message'=> 'You have succefully book an instance appoint',
        'users'=>$instance,
    ]); 

    }

    public function rescheduleAppointment(Request $request){
        $rescheduleappointment = Bookappointment::select('reschedule_comment','new_date','new_time')
                                  ->where('patient_id', $request->patient_id)
                                   ->get();

                                   return response()->json([
                                    'users'=>$rescheduleappointment,
                                   ]);
    }

    public function patientAppoint(Request $request){

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
