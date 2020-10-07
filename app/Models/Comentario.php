<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comentario extends Model
{
    use HasFactory;

     /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'contenido',
        'user_id',
        'entrada_id',
    ];
    //las dos propiedades de abajo se utilizan por si en la tabla tenemos comentario y debe ser comentarios
    protected $table = 'comentarios';
    protected $primarykey = 'id';

    
    public function entradas(){
        //return $this->belongsTo('App\Models\User','user_id','id');
        return $this->belongsTo('App\Models\Entrada');
    }
    public function users(){
        //return $this->belongsTo('App\Models\User','user_id','id');
        return $this->belongsTo('App\Models\User');
    }
}
