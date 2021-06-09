<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Representante extends Model
{
    use HasFactory;

    protected $fillable=[
        'cod_representante',
        'user_id'
    ];

    protected $table='representante';

    public function user(){
        return $this->belongsTo('App\Models\User');
    }

    public function contrato_matriculas(){
        return $this->hasMany('App\Models\Contrato_Matricula');
    }
}
