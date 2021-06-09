<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Contrato_Matricula extends Model
{
    use HasFactory;

    protected $fillable=[
        'cod_matricula',
        'confirmacion',
        'periodo_id',
        'alumno_id',
        'representante_id'
    ];

    protected $table='contrato_matricula';

    public function periodo(){
        return $this->belongsTo('App\Models\Periodo');
    }

    public function alumno(){
        return $this->belongsTo('App\Models\Alumno');
    }

    public function representante(){
        return $this->belongsTo('App\Models\Representante');
    }

    public function alumno_carga_acad(){
        return $this->hasMany('App\Models\Alumno_Carga_Acad');
    }

    public function cronograma_pagos(){
        return $this->hasMany('App\Models\Cronograma_Pagos');
    }
}
