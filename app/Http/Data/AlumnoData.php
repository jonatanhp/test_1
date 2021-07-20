<?php


namespace App\Http\Data;



use Illuminate\Support\Facades\DB;


class AlumnoData
{
    public static function getContratos($alumno_id)
    {
        $contratos = DB::table('contrato_matricula')
            ->select("id", "cod_matricula", "alumno_id", "confirmacion","periodo_id","alumno_id","representante_id", "created_at","updated_at")
           
            ->where('contrato_matricula.alumno_id', '=', $alumno_id)
            ->orderBy('contrato_matricula.id')
            ->get();

        return $contratos;
    }

    
}
