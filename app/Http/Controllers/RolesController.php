<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Rol;
use DB;
use Auth;

class RolesController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(){
        $user = Auth::user();
        return view('roles', compact('user'));
    }

    public function listar(){
        return Rol::all();
    }

    public function listarSelect(){
        return DB::table('ROLES as rol')
                    ->SELECT('rol.Id as id', 'rol.Nombre as text')
                    ->GET();
    }

    public function save(Request $r){
        try{
            if($r->id!=null){
                Rol::where('Id', $r->id)->update(["Nombre"=>$r->nombre]);
            }else{
                Rol::create(array("Nombre"=>$r->nombre));
            }
            return response()->json(array("code"=>200, "msj"=>"Se ha guardado el registro."));
        }catch(Exception $ex){
            Log::error($ex->getMessage());
            return response()->json(array("code"=>500, "msj"=>"Error en la operación, verifique su información."));
        }
    }

    public function delete(Request $r){
        try{
            Rol::where('Id', $r->id)->delete();
            return response()->json(array("code"=>200, "msj"=>"Se ha eliminado el registro."));
        }catch(Exeption $ex){
            Log::error($ex->getMessage());
            return response()->json(array("code"=>500, "msj"=>"Error en la operación, verifique su información."));
        }
    }

}
