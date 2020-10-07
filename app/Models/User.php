<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable implements MustVerifyEmail
{
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

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

    public function entradas(){
        //return $this->hasMany('App\Models\Entrada','user_id','id'); si no respetamos la convenciones, lo definimos asi si no como a continuación
        return $this->hasMany('App\Models\Entrada');
    }
    public function comentarios(){
        //return $this->belongsTo('App\Models\User','user_id','id');
        return $this->hasMany('App\Models\Comentario');
    }
    /*public function userHasRoles(){
        //return $this->belongsTo('App\Models\User','user_id','id');
        return $this->belongsToMany('App\Models\Role','role_user','user_id','user_id','role_id');
    }*/
}
