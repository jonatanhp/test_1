<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Alumno extends Model
{
    use HasFactory;

    protected $fillable=[
        'cod_alumno'
    ];

    protected $table='alumno';

    public function user(){
        return $this->belongsTo('App\Models\User');
    }

    public function alumno_carga_acads(){
        return $this->hasMany('App\Models\Alumno_Carga_Acad');
    }

    public function contrato_matriculas(){
        return $this->hasMany('App\Models\Contrato_Matricula');
    }

    public function cobranzas(){
        return $this->hasMany('App\Models\Cobranza');
    }

    public function depositos(){
        return $this->hasMany('App\Models\Deposito');
    }

    
}
