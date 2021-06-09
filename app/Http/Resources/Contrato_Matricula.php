<?php
  
namespace App\Http\Resources;
   
use Illuminate\Http\Resources\Json\JsonResource;
   
class Contrato_Matricula extends JsonResource
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
            'cod_matricula' => $this->cod_matricula,
            'confirmacion' => $this->confirmacion,
            'periodo_id' => $this->periodo_id,
            'alumno_id' => $this->alumno_id,
            'representante_id' => $this->representante_id,
            'created_at' => $this->created_at->format('d/m/Y'),
            'updated_at' => $this->updated_at->format('d/m/Y'),
        ];
    }
}