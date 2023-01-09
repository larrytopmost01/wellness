<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Tymon\JWTAuth\Exceptions\JWTException;
use JWTAuth;
use Validator;
use App\Models\User;
use App\Models\Specialization;
use App\Models\Commonhealthissue;





class AuthController extends Controller
{

    public function _construct(){
        $this->middleware('auth:api',['except'=>['login', 'register']]);
    }

    public function register(Request $request){
        $validator =Validator::make($request->all(),[
            'firstname'=>'required',
            'lastname'=>'required',
            'phone'=> 'required',
            'email'=> 'required|string|email|unique:users',
            'password'=>'required|string|confirmed|min:6'
        ]);

        if($validator->fails()){
            return response()->json($validator->errors()->toJson(), 400);
    }
 
    $certname="";
    if($request->hasFile('certificate')){
        $certname=$request->file('certificate')->store('posts', 'public');
    }else{
        $filename=Null;
    }

    $liencename="";
    if($request->hasFile('liencence')){
        $liencename=$request->file('liencence')->store('posts', 'public');
    }else{
        $liencename=Null;
    }
        $spec = Specialization::find($request->spec_id);
        $healthissue = Commonhealthissue::find($request->commonhealthissue_id);
		$user = new User();
		$user->firstname = $request->firstname;
		$user->lastname = $request->lastname;
		$user->phone = $request->phone;
		$user->email = $request->email;
        $user->spec_id = $spec->id;
        $user->password = bcrypt($request->password);
        $user->university = $request->university;
        $user->yearofgraduation = $request->yearofgraduation;
		$user->certificate =   $certname;
        $user->yearofcollection = $request->yearofcollection;
		$user->liencence = $liencename;
        $user->status = 'Pending';
        $user->Appointment_channel = 'Online';
		$user->save();

        $token = JWTAuth::fromUser($user);

        return response()->json([
            'message'=>'Doctor account created  succesfully',
            'user'=>$user,
            'token'=>$token
        ], 201);
    }

    public function login(Request $request){
     
        $user = User::where('email', $request->email)->first();
        if(!$user){
            return response()->json(
                [   'success' => false,
                    'message' => 'User not found with that email',
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
                    'user'    => JWTAuth::user()->toArray(),
                    'token_type'       => 'token',
                    'token'      => 'Bearer' . ' ' . $token,
                ]
            ];
            return response()->json($payload, Response::HTTP_OK);

    }

    public function logout(){

        auth()->logout();

        return response()->json(['message' => 'Successfully logged out']);
    }

    public function PasswordReset(Request $request){

        $userpassword = User::where('password', $request->password)->first();
        $userpassword->UPDATE([
            'password'=>bcrypt($request->password)
        ]);

        return response()->json(['message' => 'Password Change Succesfully']);

    }

    
}
