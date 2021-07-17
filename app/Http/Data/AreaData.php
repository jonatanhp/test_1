<?php


namespace App\Http\Data;


use App\Models\UserDistritoMisionero;
use App\Models\UserIglesia;
use App\Models\UserMisionAsociacion;
use App\Models\UserUnion;
use Illuminate\Support\Facades\DB;
use App\Models\Area;

class AreaData
{
    public static function getCursos($area_id)
    {
        $cursoss = DB::table('curso')
            ->select('curso.id', 'curso.nom_curso', 'area_id')
           
            ->where('curso.area_id', '=', $area_id)
            ->orderBy('curso.id')
            ->get()->first();

        return $cursoss;
    }

    public static function getArea($curso_id)
    {
        $niveles = DB::table('nivel')
            ->select('*')
           
            ->where('nivel.id', '=', $curso_id)
            ->orderBy('nivel.id')
            ->get()->first();
       
        return $niveles;
    }
}
