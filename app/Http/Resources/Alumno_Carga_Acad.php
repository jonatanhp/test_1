<?php
  
namespace App\Http\Resources;
   
use Illuminate\Http\Resources\Json\JsonResource;
use App\Models\Curso_Docente_Seccion as carga;
   
class Alumno_Carga_Acad extends JsonResource
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
            'curso_docente_seccion_id' => $this->curso_docente_seccion_id,
            'contrato_matricula_id' => $this->contrato_matricula_id,
            'alumno_id' => $this->alumno_id,
            'seccion' => carga::join("alumno_carga_acad", "curso_docente_seccion.id", "=", "alumno_carga_acad.curso_docente_seccion_id")
            ->join("seccion", "curso_docente_seccion.seccion_id", "=", "seccion.id")
            ->join("grado", "seccion.grado_id1", "=", "grado.id")
            ->where("curso_docente_seccion.id", "=", $this->curso_docente_seccion_id)
            
            ->select("alumno_carga_acad.id","curso_docente_seccion.id","seccion.nom_seccion", "grado.id", "grado.nom_grado")
            ->get()->first(),
            
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ];
    }
}