<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use DB;

class Empresa extends Model
{
    use HasFactory;

    protected $table = 'EMPRESAS';
    protected $primaryKey = 'Id';

    protected $fillable = [
        'Nombre'
    ];

    public $timestamps = false;


    public static function listarselect(){
        return DB::table('EMPRESAS')
                ->select('Id as id', 'Nombre as text')
                ->get();
    }
}
