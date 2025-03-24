<?php

use Illuminate\Database\Seeder;
use App\Models\Role;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
    // Crear roles
    $adminRole = Role::create(['name' => 'admin']);
    $userRole = Role::create(['name' => 'user']);
    $modRole = Role::create(['name' => 'moderator']);

    // Crear usuarios
    $adminUser = User::create([
        'name' => 'Admin',
        'last_name' => 'User',
        'email' => 'admin@example.com',
        'password' => bcrypt('password')
    ]);

    // Asignar rol
    $adminUser->role()->associate($adminRole);
    $adminUser->save();
    }
}
