<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Curso_Docente_Seccion extends Model
{
    use HasFactory;

    protected $fillable=[
        'fecha_inicio',
        'fecha_fin',
        'curso_id',
        'seccion_id',
        'docente_id'
    ];

    protected $table='curso_docente_seccion';

    public function curso(){
        return $this->belongsTo('App\Models\Curso');
    }

    public function docente(){
        return $this->belongsTo('App\Models\Docente');
    }

    public function seccion(){
        return $this->belongsTo('App\Models\Seccion');
    }

    public function alumno_carga_acads(){
        return $this->hasMany('App\Models\Alumno_Carga_Acad');
    }
}
