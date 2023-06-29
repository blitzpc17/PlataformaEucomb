<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use DB;
use Illuminate\Support\Facades\Hash;
use Auth;


class UsuariosController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(){
        $user = Auth::user();
        return view('usuarios', compact('user'));
    }

    public function listar(){
        return DB::table('USUARIOS as us')
                ->JOIN('ROLES as rol', 'us.ROLESId', 'rol.Id')
                ->SELECT('rol.Nombre as Rol', DB::raw("CASE WHEN us.Baja=1 THEN 'DESACTIVADO' ELSE 'ACTIVO' END as Estado"), 
                DB::raw("us.*"))
                ->ORDERBY('us.Id', 'desc')
                ->GET();
    }

    public function save(Request $r){
        $data = array(
            "name" => $r->nombre,          
            "ROLESId" => $r->rolId,
            "EMPLEADOSId"=>$r->empleadoId,
            "Baja"=>0,
            "Bloqueado"=>0,
            "Intentos"=>0
        );


        if($r->contrasena!=null && !empty($r->contrasena)){
            $data = array_merge($data, ["password" => Hash::make($r->contrasena)]);
        }

        try{
            if($r->id!=null){
                User::where('Id', $r->id)->update($data);
            }else{                
                User::create($data);
            }

            return response()->json(array("code"=>200, "msj"=>"Se ha guardado el registro."));

        }catch(Exception $ex){
            Log::error($ex->getMessage());
            return response()->json(array("code"=>500, "msj"=>"Error en la operación, verifique su información."));
        }
    }

    public function desactivar (Request $r){
        try{
            User::where('Id', $r->id)->update(array("Baja" => $r->baja==1?true:false));
            $msj = ($r->baja==1?"DESACTIVADO":"REACTIVADO");
            return response()->json(array("code"=>200, "msj"=>"Se ha {$msj} el registro."));
        }catch(Exeption $ex){
            Log::error($ex->getMessage());
            return response()->json(array("code"=>500, "msj"=>"Error en la operación, verifique su información."));
        }
    }
}
