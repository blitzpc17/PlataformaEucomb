<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Empleado;

class EmpleadosController extends Controller
{
    public function index(){
        return view('empleados');
    }

    public function listar(){
        return Empleado::all();
    }

    public function save(Request $r){
        try{

            $data = array(
                "Nombres" => $r->nombre,
                "ApellidoPaterno" => $r->apaterno,
                "ApellidoMaterno" => $r->amaterno,
                "FechaNacimiento" => $r->fechaNacimiento,
                "FechaIngreso" => $r->fechaIngreso,
                "PUESTOSId" => $r->puesto,
                "EMPRESASId" => $r->empresa,
                "Baja" => false               
            );

            if($r->cv!=null){
                $data = array_merge($data, ["Cv"=> "prueba.jpg"]);
            }

            if($r->foto!=null){
                $data = array_merge($data, ["Foto"=> "pruebaFoto.jpg"]);
            }

            if($r->id!=null){
                Empleado::where('Id', $r->id)->update($data);
            }else{
                Empleado::create($data);
            }
            return response()->json(array("code"=>200, "msj"=>"Se ha guardado el registro."));
        }catch(Exception $ex){
            Log::error($ex->getMessage());
            return response()->json(array("code"=>500, "msj"=>"Error en la operación, verifique su información."));
        }
    }

    public function delete(Request $r){
        try{
            Empleado::where('Id', $r->id)->delete();
            return response()->json(array("code"=>200, "msj"=>"Se ha eliminado el registro."));
        }catch(Exeption $ex){
            Log::error($ex->getMessage());
            return response()->json(array("code"=>500, "msj"=>"Error en la operación, verifique su información."));
        }
    }
}
