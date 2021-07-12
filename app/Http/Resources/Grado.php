<?php
  
namespace App\Http\Resources;
   
use Illuminate\Http\Resources\Json\JsonResource;

use App\Models\Nivel;


use function PHPUnit\Framework\isNull;

class Grado extends JsonResource
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
            'nom_grado' => $this->nom_grado,
            'desc_grado' => $this->desc_grado,
            'nivel_id' => $this->nivel_id, 

            //'grado' => !is_null($this->nivel_id) ? Nivel::where('idNivel', $this->id)

            'asignadoss' => ($this->nivel_id) ? Nivel::select('nom_nivel')->where('id', $this->nivel_id) :$this->nom_nivel,
                                                    

           'created_at' => $this->created_at->format('d/m/Y'),
            'updated_at' => $this->updated_at->format('d/m/Y'),
        ];
    }
}