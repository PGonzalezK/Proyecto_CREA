<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;

class SeederTablaPermisos extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $permisos = [
            

            // Permisos sobre roles
            'ver-rol',
            'crear-rol',
            'editar-rol',
            'borrar-rol',

            // Permisos sobre usuarios
            'ver-usuario',
            'crear-usuario',
            'editar-usuario',
            'borrar-usuario',

            // Permisos sobre individuos
            'ver-individuo',
            'crear-individuo',
            'editar-individuo',
            'borrar-individuo',

            // Permisos sobre documentos grupales
            'ver-grupales',

            // Permisos sobre área técnica
            'ver-area-tecnica',
            'subir-documentos-tecnica',
            'editar-documentos-tecnica',
        ];

        foreach ($permisos as $permiso) {
            Permission::firstOrCreate(['name' => $permiso]);
        }
    }
}
