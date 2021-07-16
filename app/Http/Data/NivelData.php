<?php


namespace App\Http\Data;


use App\Models\UserDistritoMisionero;
use App\Models\UserIglesia;
use App\Models\UserMisionAsociacion;
use App\Models\UserUnion;
use Illuminate\Support\Facades\DB;
use App\Models\Nivel;

class NivelData
{
    public static function getGrados($nivel_id)
    {
        $gradoss = DB::table('grado')
            ->select('grado.id', 'grado.nom_grado', 'nivel_id')
           
            ->where('grado.nivel_id', '=', $nivel_id)
            ->orderBy('grado.id')
            ->get();

        return $gradoss;
    }

    public static function getNivel($grado_id)
    {
        $niveles = DB::table('nivel')
            ->select('*')
           
            ->where('nivel.id', '=', $grado_id)
            ->orderBy('nivel.id')
            ->get()->first();
       
        return $niveles;
    }
}
