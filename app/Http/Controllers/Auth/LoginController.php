<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\LoginRequest;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    
    public function login(LoginRequest $request){


        if(Auth::attempt(['EMAIL' => $request->email, 
            'PASSWORD' => $request->password, 
            'STATUSUSER' => 1],false)){
            return response()->json([
                'response' => 'Has Iniciado Sesión',
                'status' => 200]);
        }else{
            return response()->json(['errors' => ['login' => ['Los datos que ingresaste son incorrecto']], 
                'status' => 422]);
        }
        
    }
}
