<?php

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;

class RolesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Role::create([
            "name" => "Admin",
            "guard_name" => "Administrador",
            "description" => "Es el Administrador del sistema"
        ]);

        Role::create([
            "name" => "Writter",
            "guard_name" => "Escritor",
            "description" => "Son los escritores de los posts del sistema"
        ]);

        Role::create([
            "name" => "Subscriber",
            "guard_name" => "Suscriptor",
            "description" => "Son todos los usuarios que se suscriben para ver los posts del blog"
        ]);
    }
}
