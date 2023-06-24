<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

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


}
