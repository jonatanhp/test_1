<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cronograma_Pagos extends Model
{
    use HasFactory;
    protected $fillable=[
        'fecha_limite',
        'pagado',
        'contrato_matricula_id'
        
    ];

    protected $table='cronograma_pagos';

    public function curso_docente_seccion(){
        return $this->belongsTo('App\Models\Contrato_Matricula');
    }

    
}
