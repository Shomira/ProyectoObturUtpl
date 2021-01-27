<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class Establecimiento extends Authenticatable
{
    use HasFactory, Notifiable;
/*
    // Relacion de uno a muchos
    public function registros(){
        return $this->hasMany('App\Models\Registro');

    }
    */
    protected $fillable =[
        'nombre','clasificacion',
        'categoria','habitaciones','plazas'
        
    ];
}
 