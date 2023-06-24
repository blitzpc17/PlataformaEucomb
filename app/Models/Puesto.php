<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use DB;

class Puesto extends Model
{
    use HasFactory;

    protected $table = 'PUESTOS';
    protected $primaryKey = 'Id';

    protected $fillable = [
        'Nombre'
    ];

    public $timestamps = false;

    public static function listarselect(){
        return DB::table('PUESTOS')
                ->select('Id as id', 'Nombre as text')
                ->get();
    }



}
