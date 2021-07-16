<?php


namespace App\Http\Data;

use Illuminate\Support\Facades\DB;
use App\Models\Grado;
use App\Models\Nivel;
use App\Models\Seccion;
use Illuminate\Http\Resources\Json\JsonResource;
   

class SeccionDataI extends JsonResource
{
    public static function getGradosI($seccion_id)
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
}

/*DB::table('users')
        ->join('contacts', function ($join) {
            $join->on('users.id', '=', 'contacts.user_id')->orOn(...);
        })
        ->get();*/
