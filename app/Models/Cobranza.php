<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cobranza extends Model
{
    use HasFactory;

    protected $fillable=[
        'concepto',
        'cantidad',
        'valor_unitario',
        'total',
        'alumno_id'
    ];

    protected $table='cobranza';

    public function alumnos(){
        return $this->hasMany('App\Models\Alumno');
    }

   
    
}
