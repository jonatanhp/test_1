<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ubigeo extends Model
{
    use HasFactory;

    protected $fillable=[
        'cod_departamento',
        'cod_provincia',
        'cod_distrito',
        'distrito'
        
    ];

    protected $table='ubigeo';

    public function users(){
        return $this->hasMany('App\Models\User');
    }
}
