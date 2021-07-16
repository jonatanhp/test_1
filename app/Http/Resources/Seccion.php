<?php
  
namespace App\Http\Resources;
   
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\DB;
use App\Models\Seccion as seccionR;
   
class Seccion extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'nom_seccion' => $this->nom_seccion,
            'desc_seccion' => $this->desc_seccion,
            'grado_id1' => $this->grado_id1,
            'grado_name' =>(DB::table('grado')->select('nom_grado')->where('grado.id','=', $this->grado_id1)->take(1)->get()->first()),
            //'nivel_name' =>(DB::table('nivel')->select('nom_nivel')->where('nivel.id','=', $this->grado_id1)->take(1)->get()->first()),
            'complete' => seccionR::join("grado", "grado.id", "=", "seccion.grado_id1")
            ->join("nivel", "grado.nivel_id", "=", "nivel.id")
            ->where("grado.id", "=", $this->grado_id1)
            ->select("grado_id1", "nom_grado", "nivel_id","nom_nivel")->distinct()
            ->get()->first(),
            'created_at' => $this->created_at->format('d/m/Y'),
            'updated_at' => $this->updated_at->format('d/m/Y'),
        ];
    }
}

/*$secciones [] = Seccion::join("grado", "grado.id", "=", "seccion.grado_id1")
        ->join("nivel", "grado.nivel_id", "=", "nivel.id")
        ->where("grado.id", "=", $seccion_id)
        ->select("grado_id1", "nom_grado", "nivel_id","nom_nivel")->distinct()
        ->get();
        return $secciones;*/