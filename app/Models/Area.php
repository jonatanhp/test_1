<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Area extends Model
{
    use HasFactory;

    protected $fillable=[
        'cod_area',
        'nom_area'
    ];

    protected $table='area';

    public function cursos(){
        return $this->hasMany('App\Models\Curso');
    }
}
