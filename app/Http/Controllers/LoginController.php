<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
class LoginController extends Controller
{

    public function login(Request $request)
    {
        // $email = $request->json()->email;
        $email = $request->email;
        $password = $request->password;
        if(Auth::attempt(['email'=>$email,'password'=>$password]))
        {
            $user=Auth::user();
            $token = $user->createToken('LoginToken')->accessToken;
            // $success['token']=$user->createToken("Myapptoken")->accesstoken;

            return response()->json([
                'name'=>$user->name,
                'email'=>$email,
                'token'=>$token
            ],200);
        }
        else{
            return response()->json([
                'error'=>'Unauthorized'
            ],401);
        }

    }
    public function register(Request $request)
    {
    $validates = validator($request->only('email', 'name', 'password'), [
        'name' => 'required|string|max:25',
        'email' => 'required|string|email|max:20|unique:users',
        'password' => 'required|string|min:3',
    ]);
    if ($validates->fails()) {
        return response()->json($validates->errors()->all(), 400);
    }
      $reqdata = request()->only('email','name','password');
      $reqdata['password']= Hash::make($request->password);
      $user = User::create($reqdata);
      Auth::login($user);
      $data['token_type']='Bearer';
      $data['access_token']=$user->createToken('FirstRegisterToken')->accessToken;
      $data['user']=$user;
      return response()->json($data,200);

    }
    
    public function userDetails()
    { 
        $user=Auth::guard('api')->user();
        return response()->json(['data'=> $user]);
    }
    public function logout(){
        Auth::user()->token()->delete(); //or revoke
        return response()->json([
            'error'=>'Logout Success'
        ],401);
    }
    
}
