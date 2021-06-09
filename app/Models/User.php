<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Passport\HasApiTokens;

class User extends Authenticatable
{
    use HasFactory, Notifiable, HasApiTokens;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'email',
        'ap_pat',
        'ap_mat',
        'sexo',
        'dni',
        'fecha_nac',
        'telefono',
        'ubigeo_id',
        'password',
    ];

    public function ubigeo(){
        return $this->belongsTo('App\Models\Ubigeo');
    }

    public function docentes(){
        return $this->hasMany('App\Models\Docente');
    }

    public function alumnos(){
        return $this->hasMany('App\Models\Alumno');
    }

    public function representantes(){
        return $this->hasMany('App\Models\Representante');
    }

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
}
