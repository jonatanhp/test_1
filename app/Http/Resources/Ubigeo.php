<?php
  
namespace App\Http\Resources;
   
use Illuminate\Http\Resources\Json\JsonResource;
   
class Ubigeo extends JsonResource
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
            'cod_departamento' => $this->cod_departamento,
            'cod_provincia' => $this->cod_provincia,
            'cod_distrito' => $this->cod_distrito,
            'distrito' => $this->distrito,
            
        ];
    }
}