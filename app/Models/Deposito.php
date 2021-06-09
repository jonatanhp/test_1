<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Deposito extends Model
{
    use HasFactory;
    protected $fillable=[
        'modalidad_deposito',
        'cod_operacion',
        'importe',
        'alumno_id'
        
    ];

    protected $table='deposito';

    public function alumnos(){
        return $this->hasMany('App\Models\Alumno');
    }
}
