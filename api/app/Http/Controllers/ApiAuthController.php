<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use Namshi\JOSE\JWT;
use Tymon\JWTAuth\Exceptions\JWTException;
use Tymon\JWTAuth\Facades\JWTAuth;

class ApiAuthController extends Controller
{
    public function userAuth(Request $request){

        $credentials = $request->only('email','password');
        $token = null;

        try{
            if(!$token = JWTAuth::attempt($credentials)){
                return response()->json(['error' =>'Invalid Credentials'],500 );
            }

        }catch (JWTException $exception){
            return response()->json(['error' =>'somethign went wrtong'],500 );
        }

        $user = JWTAuth::toUser($token);
        return response()->json(compact('token','user'));

    }
}
