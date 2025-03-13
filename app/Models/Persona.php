<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Persona extends Model
{
    use HasFactory;

    protected $fillable = [
        'nombre', 'apellido', 'rut', 'fecha_carnet', 'carnet_identidad', 'carta_compromiso', 'contrato_construccion',
        'post_subsidio', 'te1', 'tc6', 'reduccion', 'permiso', 'recepcion_dom',
        'prohibicion_1', 'prohibicion_2', 'autoricese', 'boleta_garantia_asistencia',
        'boleta_garantia_constructora'
    ];
}
