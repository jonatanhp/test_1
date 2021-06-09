<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Docente extends Model
{
    use HasFactory;

    protected $fillable=[
        'cod_docente',
        'user_id'
    ];

    protected $table='docente';

    public function user(){
        return $this->belongsTo('App\Models\User');
    }

    public function curso_docente_secciones(){
        return $this->hasMany('App\Models\Curso_Docente_Seccion');
    }
}
