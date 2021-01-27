<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Registro extends Model
{
    use HasFactory;

    protected $fillable =[
        'fecha','checkins',
        'checkouts','pernoctaciones','nacionales',
        'extranjeros', 'habitaciones_ocupadas', 'habitaciones_disponibles',
        'tipo_tarifa', 'tarifa_promedio', 'TAR_PER', 'ventas_netas',
        'porcentaje_ocupacion', 'revpar', 'empleados_temporales',
        'estado', 'opciones'
        
    ];
}
