<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Empresa;

class EmpresasController extends Controller
{
    public function index(){
        return view('empresas');
    }

    public function listar(){
        return Empresa::all();
    }

    public function listarSelect(){
        return Empresa::listarSelect();
    }

    public function save(Request $r){
        try{
            if($r->id!=null){
                Empresa::where('Id', $r->id)->update(["Nombre"=>$r->nombre]);
            }else{
                Empresa::create(array("Nombre"=>$r->nombre));
            }
            return response()->json(array("code"=>200, "msj"=>"Se ha guardado el registro."));
        }catch(Exception $ex){
            Log::error($ex->getMessage());
            return response()->json(array("code"=>500, "msj"=>"Error en la operación, verifique su información."));
        }
    }

    public function delete(Request $r){
        try{
            Empresa::where('Id', $r->id)->delete();
            return response()->json(array("code"=>200, "msj"=>"Se ha eliminado el registro."));
        }catch(Exeption $ex){
            Log::error($ex->getMessage());
            return response()->json(array("code"=>500, "msj"=>"Error en la operación, verifique su información."));
        }
    }
}
