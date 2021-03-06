<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Seccion extends Model
{
    use HasFactory;
    protected $fillable=[
        'nom_seccion',
        'desc_seccion',
        'grado_id1'
    ];

    protected $table='seccion';

    public function grado(){
        return $this->belongsTo('App\Models\Grado');
    }

    public function curso_docente_secciones(){
        return $this->hasMany('App\Models\Curso_Docente_Seccion');
    }
}
