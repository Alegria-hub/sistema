<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Entrada extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'titulo',
        'contenido',
        'user_id',
    ];

    public function users(){
        //return $this->belongsTo('App\Models\User','user_id','id');
        return $this->belongsTo('App\Models\User');
    }
    public function comentatrios(){
        //return $this->belongsTo('App\Models\User','user_id','id');
        return $this->hasMany('App\Models\Comentario');
    }
}
