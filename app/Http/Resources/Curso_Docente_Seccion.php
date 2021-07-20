<?php
  
namespace App\Http\Resources;
   
use Illuminate\Http\Resources\Json\JsonResource;
use App\Models\Curso_Docente_Seccion as cdsr;
use App\Models\Seccion as secR;
use App\Models\Curso as curR;
use App\Models\Docente as docR;

   
class Curso_Docente_Seccion extends JsonResource
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
            'fecha_inicio' => $this->fecha_inicio,
            'fecha_fin' => $this->fecha_fin,
            'curso_id' => $this->curso_id,
            'seccion_id' => $this->seccion_id,
            'docente_id' => $this->docente_id,
            'seccion' => secR::join("curso_docente_seccion", "seccion.id", "=", "curso_docente_seccion.seccion_id")
            ->join("grado", "seccion.grado_id1", "=", "grado.id")
            ->join("nivel", "grado.nivel_id", "=", "nivel.id")
            ->where("seccion.id", "=", $this->seccion_id)
            //->join("curso", "curso.id", "=", $this->curso_id)
            //->join("docente", "docente.id", "=", $this->docente_id)
            //->where("seccion.id", "=", $this->seccion_id)
            ->select("seccion.id","nom_seccion","grado.id","grado.nom_grado", "nivel.id", "nivel.nom_nivel")
            ->get()->first(),
            'curso'=> curR::join("curso_docente_seccion","curso.id","=","curso_docente_seccion.curso_id")
            ->where("curso.id", "=", $this->curso_id)
            ->select("curso.id","nom_curso")
            ->get()->first(),
            'docente'=> docR::join("curso_docente_seccion","docente.id","=","curso_docente_seccion.docente_id")
            ->join("users", "docente.user_id", "=", "users.id")
            ->where("docente.id", "=", $this->docente_id)
            //->where("grado.id", "=", $this->grado_id1)
            ->select("docente.id","users.name","users.ap_pat","users.ap_mat")
            ->get()->first(),
            
            
           /* 'alumno' => Alumno::join("contrato_matricula", "alumno.id", "=", "contrato_matricula.alumno_id")
            ->join("users", "alumno.user_id", "=", "users.id")
            ->where("alumno.id", "=", $this->alumno_id)
            ->select("alumno.id","cod_alumno","user_id","users.name","users.id")
            ->get()->first(),*/


            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,


        ];
    }
}