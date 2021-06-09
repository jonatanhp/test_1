<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Alumno_Carga_Acad extends Model
{
    use HasFactory;

    protected $fillable=[
        'curso_docente_seccion_id',
        'contrato_matricula_id',
        'alumno_id'
        
    ];

    protected $table='alumno_carga_acad';

    public function curso_docente_seccion(){
        return $this->belongsTo('App\Models\Curso_Docente_Seccion');
    }

    public function contrato_matricula(){
        return $this->belongsTo('App\Models\Contrato_Matricula');
    }

    public function alumno(){
        return $this->belongsTo('App\Models\Alumno');
    }

    

}
