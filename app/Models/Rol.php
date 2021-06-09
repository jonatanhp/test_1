<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Rol extends Model
{
    use HasFactory;

    protected $fillable=[
        'nom_rol',
        'desc_rol'
    ];

    protected $table='rol';

    public function permiso(){
        return $this->belongsTo('App\Models\Permiso');
    }

    public function rol_users(){
        return $this->hasMany('App\Models\Rol_User');
    }
}
