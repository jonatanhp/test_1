<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Grado extends Model
{
    use HasFactory;

    protected $fillable=[
        'nom_grado',
        'desc_grado',
        'nivel_id1'
    ];

    protected $table='grado';

    public function nivel(){
        return $this->belongsTo('App\Models\Nivel');
    }

    public function secciones(){
        return $this->hasMany('App\Models\Seccion');
    }
}
