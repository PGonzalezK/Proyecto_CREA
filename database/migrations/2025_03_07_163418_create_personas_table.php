<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePersonasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
{
    Schema::create('personas', function (Blueprint $table) {
        $table->id();
        $table->string('nombre');
        $table->string('apellido');
        $table->string('rut')->unique();

        // Documentos fijos
        $table->string('carta_compromiso')->nullable();
        $table->string('contrato_construccion')->nullable();

        // Otros documentos (10 restantes)
        $table->string('post_subsidio')->nullable();
        $table->string('te1')->nullable();
        $table->string('tc6')->nullable();
        $table->string('reduccion')->nullable();
        $table->string('permiso')->nullable();
        $table->string('recepcion_dom')->nullable();
        $table->string('prohibicion_1')->nullable();
        $table->string('prohibicion_2')->nullable();
        $table->string('autoricese')->nullable();
        $table->string('boleta_garantia_asistencia')->nullable();
        $table->string('boleta_garantia_constructora')->nullable();

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
        Schema::dropIfExists('personas');
    }
}
