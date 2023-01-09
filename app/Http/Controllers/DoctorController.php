<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Validator;
use DB;
use App\Models\Medical_profile;
use App\Models\Year_of_collection;
use App\Models\Year_of_graduation;
use App\Models\User;
use App\Models\Bank;
use App\Models\Bankdetail;
use App\Models\Nextofkin;
use App\Models\Gender;
use App\Models\Nationality;
use App\Models\Paymentrate;
use App\Models\Specialization;
use App\Models\Biodata;
use App\Models\Stateoforigin;
use App\Models\University;
use App\Models\Relationship;
use App\Models\Medicalinformation;
use App\Models\Bookappointment;
use App\Models\Doctorpayment;
use App\Models\Patient;
use App\Models\Doctorreport;
use App\Models\Available_schedule;
use App\Models\Time;
use App\Models\Days;
use App\Models\Commonhealthissue;
use App\Models\Payment;



class DoctorController extends Controller
{
    
    public function doctor_profile(Request $request){

        $validator =Validator::make($request->all(),[
           
            'name_of_university'=>'required',
            'year_of_graduation'=>'required',
            'certificate'=>'required',
            'year_of_collection'=>'required',
            'liencence'=>'required'
        ]);

        if($validator->fails()){
            return response()->json($validator->errors()->toJson(), 400);
    }

    // $cert=$request->file('certificate')->move('apidoc');
    

        $cert = $request->certificate->store('public/doctor_certificate/');
        $cert = $request->liencence->store('public/doctor_liencence/');
        $user = User::find($request->user_id);
		$doctor = new Medical_profile();
		$doctor->user_id = $user->id;
        $doctor->name_of_university = $request->name_of_university;
        $doctor->year_of_graduation = $request->year_of_graduation;
		$doctor->certificate =  $request->certificate->hashName();
        $doctor->year_of_collection = $request->year_of_collection;
		$doctor->liensence = $request->liencence->hashName();
		$doctor->save();

        return response()->json([
            'message'=>'Profile  succesfully Uploaded',
            'user'=>$doctor,
        ], 201);

    }

    public function bank_details(Request $request){
        $validator =Validator::make($request->all(),[
            'account_number'=>'required',
            'account_name'=>'required'
        ]);

        if($validator->fails()){
            return response()->json($validator->errors()->toJson(), 400);
    }

   
        $user = User::find($request->user_id);
		$bank = Bank::find($request->bank_id);
        $bankdetail = new Bankdetail();
		$bankdetail->user_id = $user->id;
        $bankdetail->bank_id = $bank->id;
		$bankdetail->account_number =  $request->account_number;
		$bankdetail->account_name = $request->account_name;
		$bankdetail->save();

        return response()->json([
            'message'=>'Your Account Details Created  succesfully',
            'user'=>$bankdetail,
        ], 201);


    }

    public function nextofkin(Request $request){
        $validator =Validator::make($request->all(),[
            'firstname'=>'required',
            'lastname'=>'required',
            'dateofbirth'=>'required',
            'email'=> 'required',
            'phone'=> 'required',
            'address'=>'required'

        ]);

        if($validator->fails()){
            return response()->json($validator->errors()->toJson(), 400);
    }

   
        $user = User::find($request->user_id);
        $nextofkin = new Nextofkin();
        $nextofkin->user_id = $user->id;
        $nextofkin->firstname = $request->firstname;
		$nextofkin->lastname =  $request->lastname;
        $nextofkin->gender =  $request->gender;
        $nextofkin->relationship = $request->relationship;
        $nextofkin->dateofbirth =  $request->dateofbirth;
		$nextofkin->email = $request->email;
        $nextofkin->phone = $request->phone;
        $nextofkin->nationalty =  $request->nationalty;
        $nextofkin->address =  $request->address;
		$nextofkin->save();

        return response()->json([
            'message'=>'Your Nexofkin Created  succesfully',
            'user'=>$nextofkin,
        ], 201);



    }

    public function paymentrate(Request $request){

        $validator =Validator::make($request->all(),[
            'rate'=>'required',
        ]);

        if($validator->fails()){
            return response()->json($validator->errors()->toJson(), 400);
    }

        $special = Specialization::find($request->special_id);
        $user = Specialization::find($request->user_id);
        $rate = new Paymentrate();
        $rate->user_id = $user->id;
        $rate->special_id = $special->id;
        $rate->rate = $request->rate;
		$rate->save();

        return response()->json([
            'message'=>'Your Paymentrate Created  succesfully',
            'user'=>$rate,
        ], 201);

    }

    public function biodata(Request $request){
        $validator =Validator::make($request->all(),[
            'nationalty'=> 'required',            
            'stateoforigin'=> 'required',
            'phone'=> 'required',
            'mothermaidenname'=>'required',
            'address'=>'required',


        ]);

        if($validator->fails()){
            return response()->json($validator->errors()->toJson(), 400);
    }

    $user = User::find($request->id);
    $user->firstname = $request->firstname;
    $user->lastname = $request->lastname;
    $user->phone = $request->phone;
    $user->save();

        $user = User::find($request->user_id);
        $bio = new Biodata();
        $bio->user_id = $user->id;
        $bio->nationalty = $request->nationalty;
        $bio->phone =$request->phone;
        $bio->stateoforigin = $request->stateoforigin;
        $bio->dateofbirth = $request->dateofbirth;
        $bio->mothermaidenname = $request->mothermaidenname;
        $bio->address = $request->address;
		$bio->save();

        return response()->json([
            'message'=>'Your Biodata Created  succesfully',
            'Doctor Bio'=>$bio,
        ], 201);

    }

   

    public function medicalinfo(Request $request){

        $validator =Validator::make($request->all(),[
            'year_of_experience'=> 'required',            
            'comment'=> 'required',
            'workmedium'=> 'required',

        ]);

        if($validator->fails()){
            return response()->json($validator->errors()->toJson(), 400);
    }

        $user = User::find($request->user_id);
        $medic = new Medicalinformation();
        $medic->user_id = $user->id;
        $medic->year_of_experience = $request->year_of_experience;
        $medic->comment =$request->comment;
        $medic->workmedium = $request->workmedium;
		$medic->save();

        return response()->json([
            'message'=>'Your Medical Information Created  succesfully',
            'user'=>$medic,
        ], 201);

    }

    public function appointmentUpdate(Request $request ,$id){

     
        $book = Bookappointment::find($request->id);
        $book->date = $request->date;
        $book->start_time = $request->start_time;
        $book->end_time = $request->end_time;
        $book->reschedule_comment = $request->comment;
        $book->status ='Reschedule';
		$book->save();

        return response()->json([
            'message'=>'You have succesfully  updated the appointment',
            'user'=>$book,
        ], 201);


    }

    public function doctorprofile(Request $request){
        $doctorprofile = User::select('id','firstname','lastname')
        ->where('id', $request->user_id)
        ->with(['paymentrate'])->get();

        return response()->json([
            'users'=>$doctorprofile,
        ]); 
    }

    public function doctorpatient(Request $request){
        $doctorpatient = Bookappointment::select('id','patient_id','commonhealthissue_id','date','start_time','end_time','comment','status')
        ->where('user_id', $request->user_id)
        ->with(['patient', 'medicalhistory','medicalinformation','commonhealthissue'])
        ->get();

        return response()->json([
            'users'=>$doctorpatient,
        ]); 
    }

    public function Approve($id){

        $approve = Bookappointment::find($id);
        $approve->status ='Approved';
        $approve->save();

        return response()->json([
            'message'=>'You have succesfully  approved your patient',
            'users'=>$approve,
        ]); 

    }

    public function doctorPayment(Request $request){

        $validator =Validator::make($request->all(),[
            'amount'=> 'required',            
            'transaction_type'=> 'required',
            'recepient'=> 'required',
            'sender'=> 'required',
            'date'=> 'required',
            'transaction_status'=> 'required',

        ]);

        if($validator->fails()){
            return response()->json($validator->errors()->toJson(), 400);
    }

        $user = User::find($request->user_id);
        $docpay = new Doctorpayment();
        $docpay->user_id = $user->id;
        $docpay->transactionid = $request->transactionid;
        $docpay->amount =$request->amount;
        $docpay->transaction_type = $request->transaction_type;
        $docpay->sender = $request->sender;
        $docpay->recepient = $request->recepient;
        $docpay->date = $request->date;
        $docpay->transaction_status = $request->transaction_status;
		$docpay->save();

        return response()->json([
            'message'=>'You have  succesfully made payment to the doctor',
            'Doctor Pay'=>$docpay,
        ], 201);
        
    }

    public function paymentView(Request $request){

        $doctorpayment = User::select('id','firstname', 'lastname')
        ->with('payments')
         ->where('id', $request->user_id)
         ->get();
        // $payview = DB::table('payments')
        //            ->join('users', 'users.id','payments.user_id')
        //            ->join('patients', 'patients.id','payments.patient_id')
        //         //    ->join('specializations', 'specializations.id','users.spec_id')
        //            ->select('payments.amount','payments.date','payments.transaction_type','patients.name','payments.status','payments.ref','users.firstname', 'users.lastname')
        //            ->where('user_id', $request->user_id)
        //            ->get();

        return response()->json([
            'Doctorpayment'=>$doctorpayment,
        ]); 
    }

    public function patientAppointment(Request $request){

        $bookappoint =  $report = DB::table('bookappointments')
                        ->join('patients','patients.id', '=', 'bookappointments.patient_id')
                        ->join('users','users.id', '=', 'bookappointments.user_id')
                        ->select('patients.id','patients.name','patients.email','patients.phone','bookappointments.date','bookappointments.start_time','bookappointments.end_time','bookappointments.comment','bookappointments.status', 'users.firstname','users.lastname')
                        ->where('users.id', $request->user_id)
                        ->get();

        // $patientappoint = Bookappointment::select('id','patient_id','date','start_time','end_time','comment')
        // ->with('patient')
        // ->where('patient_id', $request->patient_id)
        // ->get();

        return response()->json([
            'Patient_Appointment'=>$bookappoint,
        ]); 
    }

    public function doctorReport(Request $request){
                                                                                                                  
        $validator =Validator::make($request->all(),[
            'comment'=> 'required',            

        ]);

        $user = User::find($request->user_id);
        $patient = Patient::find($request->patient_id);
        $docreport = new Doctorreport();
        $docreport->user_id = $user->id;
        $docreport->patient_id = $patient->id;
        $docreport->date = $request->date;
        $docreport->comment = $request->comment;
        $docreport->save();

        return response()->json([
            'Doctorcomment'=>$docreport,
        ]); 

    }

    public function availableSchedule(Request $request){
        $user = User::find($request->user_id);
        $days = Days::find($request->day_id);
        $time = Time::find($request->time_id);
        $avail_schedule = new Available_schedule();
        $avail_schedule->user_id = $user->id;
        $avail_schedule->day_id = $days->id;
        $avail_schedule->time_id = $time->id;
        $avail_schedule->save();

        return response()->json([
            'Doctorcomment'=>$avail_schedule,
        ]); 

    }

    public function  all_Time(){

        $alltime = Time::all();
    

    return response()->json([
        'Time'=>$alltime,
    ]); 

}

public function  all_Day(){

    $allday= Days::all();


return response()->json([
    'Days'=>$allday,
]); 

}

public function  all_Bank(){

    $allbank = Bank::all();

return response()->json([
    'Banks'=>$allbank,
]); 

}

public function  specialization(){

    $special = Specialization::all();

return response()->json([
    'Specialization'=>$special,
]); 


}

public function  healthIssue(){

    $health = Commonhealthissue::all();

return response()->json([
    'healthissue'=>$health,
]); 


}

public function getdoctorReport(Request $request){

 
    $report = DB::table('doctorreports')
               ->join('patients','patients.id', '=', 'doctorreports.patient_id')
               ->join('users','users.id', '=', 'doctorreports.user_id')
               ->join('bookappointments','bookappointments.id', '=', 'doctorreports.bookappointment_id')
               ->select('patients.name','patients.email','patients.phone','doctorreports.comment', 'users.firstname','users.lastname','bookappointments.date')
               ->where('patients.id', $request->patient_id)
               ->get();

    return response()->json([
        'DoctorReport'=>$report,
    ]); 
}

public function doctorWeeklyEarning(Request $request){

    $doocpay = DB::table('payments')
               ->join('patients', 'patients.id', 'payments.patient_id')
               ->select('payments.amount','payments.date','patients.name')
               ->where('user_id', $request->user_id)
               ->get();

               return response()->json([
                'Doctor_daily_earning'=>$doocpay,
            ]); 

}

public function expectedPayout(Request $request){
    $payout = DB::table('paymentrates')
              ->join('users', 'users.id', 'paymentrates.user_id')
              ->select('paymentrates.expected_payout', 'users.firstname','users.lastname')
              ->where('user_id' , $request->user_id)
              ->get();

              return response()->json([
                'Doctor_expected_payout'=>$payout,
            ]); 
}

public function totalEarning(Request $request){
    $payout = DB::table('paymentrates')
              ->join('users', 'users.id', 'paymentrates.user_id')
              ->select('paymentrates.totalearning', 'users.firstname','users.lastname')
              ->where('user_id' , $request->user_id)
              ->get();

              return response()->json([
                'Doctor_expected_payout'=>$payout,
            ]); 
}

}
