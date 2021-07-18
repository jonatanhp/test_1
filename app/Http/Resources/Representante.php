<?php
  
namespace App\Http\Resources;
   
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\DB;
use App\Models\Representante as repreR;
   
class Representante extends JsonResource
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
            'cod_representante' => $this->cod_representante,
            'user_id' => $this->user_id,
            'complete' => repreR::join("users", "users.id", "=", "representante.user_id")
            //->join("nivel", "users.nivel_id", "=", "nivel.id")
            ->where("users.id", "=", $this->user_id)
            ->select("sexo", "name", "ap_pat","ap_mat")
            ->get()->first(),
            'created_at' => $this->created_at->format('d/m/Y'),
            'updated_at' => $this->updated_at->format('d/m/Y'),
        ];
    }
}