<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;

class InicioController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    
    public function index(){
        $user = Auth::user();
        return view('dashboard', compact('user'));
    }
}
