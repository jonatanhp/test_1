<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Periodo extends Model
{
    use HasFactory;

    protected $fillable=[
        'nom_periodo',
        'desc_periodo',
        'estado'
        
    ];

    protected $table='periodo';

    

    public function contrato_matriculas(){
        return $this->hasMany('App\Models\Contrato_Matricula');
    }
}
