<?php

use App\User;
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
        $roleAdmin = Role::create([
            "name" => "Admin",
            "guard_name" => "web",
            "display_name" => "Administrador",
            "description" => "Es el Administrador del sistema"
        ]);

        $roleWritter = Role::create([
            "name" => "Writter",
            "guard_name" => "web",
            "display_name" => "Escritor",
            "description" => "Son los escritores de los posts del sistema"
        ]);

        $roleSubscriber = Role::create([
            "name" => "Subscriber",
            "guard_name" => "web",
            "display_name" => "Suscriptor",
            "description" => "Son todos los usuarios que se suscriben para ver los posts del blog"
        ]);

        $roleModerator = Role::create([
            "name" => "Moderator",
            "guard_name" => "web",
            "display_name" => "Moderador",
            "description" => "Son los usuarios moderadores de comentarios en el blog"
        ]);

        $admin = User::create([
            "name" => "Fernando Daniel",
            "last_name" => "Romano",
            "email" => "fernando@gmail.com",
            "photo" => "/admin/img/foto_perfil.jpg",
            "password" => bcrypt('fer4236814'),
        ]);

        $admin->assignRole($roleAdmin);

        $writter = User::create([
            "name" => "Evangelina",
            "last_name" => "Ibarra",
            "email" => "eva@gmail.com",
            "photo" => "/admin/img/foto_perfil.jpg",
            "password" => bcrypt('fer4236814'),
        ]);

        $writter->assignRole($roleWritter);

        $subscriber = User::create([
            "name" => "Nicolas Gabriel",
            "last_name" => "Romano",
            "email" => "nicolas@gmail.com",
            "photo" => "/admin/img/foto_perfil.jpg",
            "password" => bcrypt('fer4236814'),
        ]);

        $subscriber->assignRole($roleSubscriber);
    }
}
