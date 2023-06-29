<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Session;


class AuthController extends Controller
{
    public function Authenticate(Request $r){
        if (Auth::attempt(['name' => $r->usuario, 'password' => $r->password])) {         
            $user = auth()->user();
            if($user->Baja==1){
                return back()->withErrors([                       
                    'usuario' => '*Usuario inactivo'
                ]);
            }
            return redirect()->intended('/')->withSuccess("¡Bienvenido de nuevo! Fecha de Acceso: ".date('d-m-Y H:i:s'));
        }

        return back()->withErrors([
            'usuario' => '*Verifique su cuenta de correo',
            'password' => '*Verifique su contraseña'
        ])->withInput();;
    }

    public function Logout(Request $r){
        Session::flush();
        Auth::logout();
  
        return Redirect('login');
    }




}
