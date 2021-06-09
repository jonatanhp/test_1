<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Nivel extends Model
{
    use HasFactory;

    protected $fillable=[
        'nom_nivel',
        'desc_nivel'
    ];

    protected $table='nivel';


    public function grados(){
        return $this->hasMany('App\Models\Grado');
    }
}