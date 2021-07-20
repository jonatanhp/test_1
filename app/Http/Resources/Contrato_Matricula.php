<?php
  
namespace App\Http\Resources;
   
use Illuminate\Http\Resources\Json\JsonResource;
use App\Models\Alumno;
use App\Models\Periodo;
use App\Models\Representante;
   
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
            'alumno' => Alumno::join("contrato_matricula", "alumno.id", "=", "contrato_matricula.alumno_id")
            ->join("users", "alumno.user_id", "=", "users.id")
            ->where("alumno.id", "=", $this->alumno_id)
            ->select("alumno.id","cod_alumno","user_id","users.name","users.id")
            ->get()->first(),
            'representante' => Representante::join("contrato_matricula", "representante.id", "=", "contrato_matricula.representante_id")
            ->join("users", "representante.user_id", "=", "users.id")
            ->where("representante.id", "=", $this->representante_id)
            ->select("representante.id","cod_representante","user_id","users.name","users.id")
            ->get()->first(),
            'periodo' => Periodo::join("contrato_matricula", "periodo.id", "=", "contrato_matricula.periodo_id")
            ->where("periodo.id", "=", $this->periodo_id)
            ->select("periodo.id","nom_periodo","estado")
            ->get()->first(),
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ];
    }
}