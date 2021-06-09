<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Rol_User extends Model
{
    use HasFactory;

    protected $fillable=[
        'rol_id',
        'user_id'
    ];

    protected $table='rol_usuario';

    public function rol(){
        return $this->belongsTo('App\Models\Rol');
    }

    public function user(){
        return $this->belongsTo('App\Models\User');
    }
}
