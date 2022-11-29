<?php

namespace App\Http\Controllers;

use Facade\FlareClient\Http\Response;
use Illuminate\Http\Request;
use App\Http\Requests\LoginFormRequest;
use Illuminate\Support\Facades\Auth;
class AuthenticationController extends Controller
{
    public function iniciarSesion(LoginFormRequest $request){
        if (Auth::attempt(['email'=> $request->email,'password'=> $request->password],false)) {
            // Authentication passed...
            return response()->json('Has iniciado sesión',200);
        }else{

            return response()->json(['errors'=>['login'=>['Los datos  que ingresaste son incorrectos']]],422);
        }
    }
    public function getUser(){
        return Auth::user();
    }
}
