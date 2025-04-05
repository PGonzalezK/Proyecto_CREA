<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;

class PermisosIndividuoSeeder extends Seeder
{
    public function run(): void
    {
        $permisos = [
            'ver-individuo',
            'crear-individuo',
            'editar-individuo',
            'borrar-individuo',
            'mostrar-individuo'
        ];

        foreach ($permisos as $permiso) {
            Permission::firstOrCreate(['name' => $permiso]);
        }
    }
}