<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Empleado;
use DB;
use Auth;

class EmpleadosController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    
    public function index(){
        $user = Auth::user();
        return view('empleados', compact($user));
    }

    public function listar(){
        return Empleado::listar();
    }

    public function listarSelect(){
        return DB::table('EMPLEADOS as emp')
                ->SELECT('emp.Id as id', DB::raw("concat(emp.Nombres, ' ', emp.ApellidoPaterno, ' ', emp.ApellidoMaterno) as text"))
                ->GET();
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

    public function baja(Request $r){
        try{
            Empleado::where('Id', $r->id)->update(array("Baja" => ($r->baja==1?true:false) ));
            $msj = "";
            if($r->baja == 1){
                $msj="Se ha dado de baja el registro.";
            }else{
                $msj = "Se ha reactivado el registro.";
            }
            return response()->json(array("code"=>200, "msj"=>$msj));
        }catch(Exeption $ex){
            Log::error($ex->getMessage());
            return response()->json(array("code"=>500, "msj"=>"Error en la operación, verifique su información."));
        }
    }
}
