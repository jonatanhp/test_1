<?php


namespace App\Http\Data;

use Illuminate\Support\Facades\DB;

class GradoData
{
    public static function getSecciones($grado_id)
    {
        $secciones = DB::table('seccion')
            ->select('seccion.id', 'seccion.nom_seccion', 'grado_id1')
           
            ->where('seccion.grado_id1', '=', $grado_id)
            ->orderBy('seccion.id')
            ->get();

        return $secciones;
    }
}
