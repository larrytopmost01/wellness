<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DoctorController;
use App\Http\Controllers\PatientController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\ChangePasswordController;


/*
|-- ------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::group(['middleware'=>'api','prefix'=>'auth'],function($router){
    Route::post('/register',[AuthController::class,'register']);
    Route::post('/login',[AuthController::class,'login']);
    Route::get('/logout',[AuthController::class,'logout']);

});

Route::group(['middleware'=>'api','prefix'=>'auth'],function($router){
    Route::post('/register',[PatientController::class, 'register']);
    Route::post('/login',[PatientController::class, 'login']);

});
   
Route::post('/change_password',[ChangePasswordController::class,'change_Password']);

Route::post('/doctor_profile',[DoctorController::class, 'doctor_profile']);
Route::post('/bank-detail',[DoctorController::class, 'bank_details']);
Route::post('/nextofkin',[DoctorController::class, 'nextofkin']);
Route::post('/paymentrate',[DoctorController::class, 'paymentrate']);
Route::post('/biodata',[DoctorController::class, 'biodata']);
Route::post('/file_upload',[DoctorController::class, 'uploadfile']);
Route::post('/medicalinformation',[DoctorController::class, 'medicalinfo']);
Route::get('/doctor_details/{user_id}',[DoctorController::class, 'doctorprofile']);
Route::post('/updatedappointment/{user_id}',[DoctorController::class, 'appointmentUpdate']);
Route::get('/doctor_patient/{user_id}',[DoctorController::class, 'doctorpatient']);
Route::post('/approve/{id}',[DoctorController::class, 'Approve']);
Route::post('/doctorpayment',[DoctorController::class, 'doctorPayment']);
Route::get('/paymentview/{user_id}',[DoctorController::class, 'paymentView']);
Route::get('/patientappointment/{user_id}',[DoctorController::class, 'patientAppointment']);
Route::post('/doctorreport',[DoctorController::class, 'doctorReport']);
Route::post('/availableschedule',[DoctorController::class, 'availableSchedule']);
Route::get('/time',[DoctorController::class, 'all_Time']);
Route::get('/day',[DoctorController::class, 'all_Day']);
Route::get('/bank',[DoctorController::class, 'all_Bank']);
Route::get('/specialization',[DoctorController::class, 'specialization']);
Route::get('/healthissue',[DoctorController::class, 'healthIssue']);
Route::get('/getdoctor_report/{patient_id}',[DoctorController::class, 'getdoctorReport']);
Route::get('/doctor_Weekly_earning/{user_id}',[DoctorController::class, 'doctorWeeklyEarning']);
Route::get('/expected_payout/{user_id}',[DoctorController::class, 'expectedPayout']);
Route::get('/totalearning/{user_id}',[DoctorController::class, 'totalEarning']);


Route::get('/doctor',[AdminController::class, 'doctorInformation']);
Route::get('/allpatient',[AdminController::class, 'allPatient']);
Route::get('/telemedicine',[AdminController::class, 'teleMedicine']);
Route::get('/get_transaction',[AdminController::class, 'getTransaction']);
Route::post('/approveTransaction/{user_id}',[AdminController::class, 'approveTransaction']);
Route::post('/approvedoctor/{id}',[AdminController::class, 'approveDoctor']);
Route::post('/declinedoctor/{id}',[AdminController::class, 'declineDoctor']);
Route::get('/patient_bookedAppointments/{patient_id}',[AdminController::class, 'patientBookedAppointments']);



Route::post('/medical_history',[PatientController::class, 'medicalhistory']);
Route::post('/bookapointment',[PatientController::class, 'apointment']);
Route::post('/instance_service',[PatientController::class, 'instanceservice']);
Route::get('/doctor_profiles',[PatientController::class, 'doctorprofiles']);
Route::get('/doctortime',[PatientController::class, 'doctorTime']);
Route::get('/specialization',[PatientController::class, 'specialization']);
Route::post('/hospital_visit',[PatientController::class, 'hospitalvisit']);
Route::get('/specializationusers/{spec_id}',[PatientController::class, 'specializationUsers']);
Route::get('/specializationusers/{spec_id}',[PatientController::class, 'specializationUsers']);
Route::get('/getDoctorProfilesbyId/{user_id}',[PatientController::class, 'getDoctorProfilesbyId']);
Route::get('/search_appointment/{user_id}',[PatientController::class, 'searchappointment']);
Route::get('/rescheduleAppointment/{patient_id}',[PatientController::class, 'rescheduleAppointment']);
Route::get('/patientappoint/{patient_id}',[PatientController::class, 'patientAppoint']);







