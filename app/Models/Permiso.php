<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Permiso extends Model
{
    use HasFactory;

    protected $fillable=[
        'nom_permiso',
        'desc_permiso'
    ];

    protected $table='permisos';

    public function roles(){
        return $this->hasMany('App\Models\Rol');
    }
}
