<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\UpdatePasswordRequest;
use Symfony\Component\HttpFoundation\Response;
use Validator;
use Illuminate\Support\Facade\DB;
use App\Models\User;
use Hash;

class ChangePasswordController extends Controller
{
   public function change_password(Request $request){

    $validate = Validator::make($request->all(), [
        'old_password' => 'required',
        'password'=> 'required|min:6|max:20',
        'confirm_password'=> 'required|same:password'
    ]);
    if($validate->fails()){
        return response()->json([
            'message'=>' Validation fails',
            'errors'=> $validate->errors()
        ], 422);
    }
    $user=$request->user();
    if(!Hash::check($request->old_password, $user->password)){

        return response()->json([
            'message'=> 'Your old password does not match'
        ], 200);

    } 
    
     if(Hash::check($request->password, $user->password)){

        return response()->json([
            'message'=> 'Your new password same as your old password'
        ], 200);

    } if(Hash::check($request->old_password, $user->password)){
        $user->update([
            'password'=>Hash::make($request->password)
        ]);

        return response()->json([
            'message'=> 'Password has been sucessfully change'
        ], 200);
    }else{
        return response()->json([
            'message'=> 'Old password does not match'
        ], 400);
     }
 }

}
