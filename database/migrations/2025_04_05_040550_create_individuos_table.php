<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateIndividuosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('individuos', function (Blueprint $table) {
            $table->id();
            $table->unsignedTinyInteger('id_empresa')->nullable(); // o ->default(1)
            $table->string('nombre');
            $table->string('apellido');
            $table->string('rut');
            $table->string('codigo_serviu')->nullable();
            $table->date('fecha_carnet')->nullable();
            $table->string('anteproyecto')->nullable();
            $table->string('apruebase')->nullable();
            $table->string('cert_electrico')->nullable();
            $table->string('cert_sitio_eriazo')->nullable();
            $table->string('cert_avaluo_detallado')->nullable();
            $table->string('cert_informaciones_p')->nullable();
            $table->string('comite_agua')->nullable();
            $table->string('escritura')->nullable();
            $table->string('estudio')->nullable();
            $table->string('titulo')->nullable();
            $table->string('registro_social_hogares')->nullable();
            $table->string('carnet_identidad')->nullable();
            $table->string('carta_compromiso')->nullable();
            $table->string('contrato_construccion')->nullable();
            $table->string('te1')->nullable();
            $table->string('tc6')->nullable();
            $table->string('reduccion')->nullable();
            $table->string('permiso')->nullable();
            $table->string('recepcion_dom')->nullable();
            $table->string('prohibicion_1')->nullable();
            $table->string('prohibicion_2')->nullable();
            $table->string('autoricese')->nullable();
            
            $table->timestamps();
        });
        
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('individuos');
    }
}
