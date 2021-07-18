<?php
  
namespace App\Http\Resources;
   
use Illuminate\Http\Resources\Json\JsonResource;
   
class User extends JsonResource
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
            'name' => $this->name,
            'ap_pat' => $this->ap_pat,
            'ap_mat' => $this->ap_mat,
            'dni' => $this->dni,
            'email' => $this->email,
            'sexo' => $this->sexo,
            'fecha_nac'=> $this->fecha_nac,
            'telefono' => $this->telefono,
            'ubigeo_id' => $this->ubigeo_id,
            'email' => $this->email,

            'created_at' => $this->created_at->format('d/m/Y'),
            'updated_at' => $this->updated_at->format('d/m/Y'),
        ];
    }
}