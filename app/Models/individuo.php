<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Individuo extends Model
{
    use HasFactory;

    protected $table = 'individuos';

    protected $fillable = [
        'id_empresa',
        'nombre',
        'apellido',
        'rut',
        'codigo_serviu',
        'fecha_carnet',
        'anteproyecto',
        'apruebase',
        'cert_electrico',
        'cert_sitio_eriazo',
        'cert_avaluo_detallado',
        'cert_informaciones_p',
        'comite_agua',
        'escritura',
        'estudio',
        'titulo',
        'registro_social_hogares',
        'carnet_identidad',
        'carta_compromiso',
        'contrato_construccion',
        'te1',
        'tc6',
        'reduccion',
        'permiso',
        'recepcion_dom',
        'prohibicion_1',
        'prohibicion_2',
        'autoricese',
    ];
}
