<?php
  
namespace App\Http\Resources;
   
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\DB;
   
class Curso extends JsonResource
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
            'cod_curso' => $this->cod_curso,
            'nom_curso' => $this->nom_curso,
            'nota_max' => $this->nota_max,
            'num_horas_p' => $this->num_horas_p,
            'num_horas_np' => $this->num_horas_np,
            'estado_curso' => $this->estado_curso,
            'area_id' => $this->area_id,
            'area_name' =>(DB::table('area')->select('nom_area')->where('area.id','=', $this->area_id)->take(1)->get()->first()),
            
        ];
    }
}