<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddCarnetIdentidadToPersonasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('personas', function (Blueprint $table) {
            $table->string('carnet_identidad')->nullable()->after('fecha_carnet'); // Agrega la columna
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('personas', function (Blueprint $table) {
            $table->dropColumn('carnet_identidad'); // Permite revertir la migración
        });
    }
}
