<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Rol;

class RolesController extends Controller
{
    public function index(){
        return view('roles');
    }

    public function listar(){
        return Rol::all();
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
