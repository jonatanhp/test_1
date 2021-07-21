<?php


namespace App\Http\Data;


use App\Models\UserDistritoMisionero;
use App\Models\UserIglesia;
use App\Models\UserMisionAsociacion;
use App\Models\UserUnion;
use Illuminate\Support\Facades\DB;
use App\Models\Nivel;

class MatriculaData
{
    public static function getGrados($nivel_id)
    {
       
        $gradoss = DB::table('grado')
        ->select('grado.id', 'grado.nom_grado')
       
        ->where('grado.nivel_id', '=', $seccion_id)
        ->orderBy('grado.id')
        ->get();

    return $gradoss;

    $gradoNivel=DB::table('seccion')
    ->join('grado', function ($join) {
        $join->on('seccion.grado_id1', '=', 'grado.id');
    }
    
    )
    ->join('nivel', function ($join) {
        $join->on('nivel.id', '=', 'grado.nivel_id');
    })
    
    ->get();


    $secciones [] = Seccion::join("grado", "grado.id", "=", "seccion.grado_id1")
    ->join("nivel", "grado.nivel_id", "=", "nivel.id")
    ->where("grado.id", "=", $seccion_id)
    ->select("grado_id1", "nom_grado", "nivel_id","nom_nivel")->distinct()
    ->get();
    return $secciones;
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

    public static function getCargasOfContrato($alumno_id)
    {
        $contratos = DB::table('alumno_carga_acad')
            ->select("id", "curso_docente_seccion_id", "contrato_matricula_id", "alumno_id","created_at","updated_at")
           
            ->where('alumno_carga_acad.alumno_id', '=', $alumno_id)
            ->orderBy('alumno_carga_acad.id')
            ->get();

        return $contratos;
    }
}
