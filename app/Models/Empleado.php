<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use DB;

class Empleado extends Model
{
    use HasFactory;

    protected $table = 'EMPLEADOS';
    protected $primaryKey = 'Id';

    protected $fillable = [
        'Nombres',
        'ApellidoPaterno',
        'ApellidoMaterno',
        'FechaNacimiento',
        'Foto',
        'Cv',
        'FechaIngreso',
        'PUESTOSId',
        'EMPRESASId',
        'FechaBaja',
        "Baja"

    ];

    public static function listarselect(){
        return DB::table('PUESTOS')
                ->select('Id as id', 'Nombre as text')
                ->get();
    }

    public static function listar(){
        return DB::table('EMPLEADOS as emp')
                ->JOIN('PUESTOS as pue', 'emp.PUESTOSId', 'pue.Id')
                ->JOIN('EMPRESAS as em', 'emp.EMPRESASId', 'em.Id')
                ->SELECT( DB::RAW("concat(emp.Nombres, ' ', emp.ApellidoPaterno, ' ', emp.ApellidoMaterno) as Nombre"), 
                        DB::RAW("CASE WHEN emp.Baja=0 THEN 'ACTIVO' ELSE 'BAJA' END AS Estado"), 'em.Nombre as Empresa', DB::RAW("emp.*") )
                ->ORDERBYDESC('emp.Id')
                ->GET();
    }




}
