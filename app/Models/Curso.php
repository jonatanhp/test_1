<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Curso extends Model
{
    use HasFactory;

    protected $fillable=[
        'cod_curso',
        'nom_curso',
        'nota_max',
        'num_horas_p',
        'num_horas_np',
        'estado_curso'
    ];

    protected $table='curso';

    public function area(){
        return $this->belongsTo('App\Models\Area');
    }

    public function curso_docente_secciones(){
        return $this->hasMany('App\Models\Curso_Docente_Seccion');
    }
}
