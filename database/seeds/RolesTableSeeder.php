<?php

use App\Comment;
use App\User;
use Carbon\Carbon;
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
        /* ROLES CREADOS */
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

        /* ASIGNANDO PERMISOS A LOS ROLES */

        $roleAdmin->givePermissionTo('View Permissions');
        $roleAdmin->givePermissionTo('Update Permissions');
        $roleAdmin->givePermissionTo('View Roles');
        $roleAdmin->givePermissionTo('Create Roles');
        $roleAdmin->givePermissionTo('Update Roles');
        $roleAdmin->givePermissionTo('Delete Roles');
        $roleAdmin->givePermissionTo('View Posts');
        $roleAdmin->givePermissionTo('Create Posts');
        $roleAdmin->givePermissionTo('Update Posts');
        $roleAdmin->givePermissionTo('Delete Posts');
        $roleAdmin->givePermissionTo('Show Posts');
        $roleAdmin->givePermissionTo('Update Approved Posts');
        $roleAdmin->givePermissionTo('View Users');
        $roleAdmin->givePermissionTo('Create Users');
        $roleAdmin->givePermissionTo('Update Users');
        $roleAdmin->givePermissionTo('Delete Users');
        $roleAdmin->givePermissionTo('View Tags');
        $roleAdmin->givePermissionTo('Create Tags');
        $roleAdmin->givePermissionTo('Update Tags');
        $roleAdmin->givePermissionTo('Delete Tags');
        $roleAdmin->givePermissionTo('View Categories');
        $roleAdmin->givePermissionTo('Create Categories');
        $roleAdmin->givePermissionTo('Update Categories');
        $roleAdmin->givePermissionTo('Delete Categories');
        $roleAdmin->givePermissionTo('View Comments');
        $roleAdmin->givePermissionTo('Create Comments');
        $roleAdmin->givePermissionTo('Update Comments');
        $roleAdmin->givePermissionTo('Delete Comments');

        $roleWritter->givePermissionTo('View Posts');
        $roleWritter->givePermissionTo('Create Posts');
        $roleWritter->givePermissionTo('Update Posts');
        $roleWritter->givePermissionTo('Delete Posts');
        $roleWritter->givePermissionTo('Show Posts');
        $roleWritter->givePermissionTo('Create Comments');

        $roleSubscriber->givePermissionTo('Create Comments');

        $roleModerator->givePermissionTo('View Posts');
        $roleModerator->givePermissionTo('Show Posts');
        $roleModerator->givePermissionTo('Update Approved Posts');
        $roleModerator->givePermissionTo('Create Comments');
        $roleModerator->givePermissionTo('Update Comments');
        $roleModerator->givePermissionTo('Delete Comments');

        /* USUARIOS CREADOS Y ASIGNADOS A LOS ROLES */
        $admin = User::create([
            "name" => "Fernando Daniel",
            "last_name" => "Romano",
            "email" => "fernandoreceptor2014@gmail.com",
            "photo" => "/admin/img/foto_perfil.jpg",
            "password" => bcrypt('fer4236814'),
            "active" => true,
            "email_verified_at" => Carbon::now(),
        ]);

        $admin->assignRole($roleAdmin);

        $writter = User::create([
            "name" => "Evangelina",
            "last_name" => "Ibarra",
            "email" => "evaibarra2016@gmail.com",
            "photo" => "/admin/img/foto_perfil.jpg",
            "password" => bcrypt('fer4236814'),
            "active" => true,
            "email_verified_at" => Carbon::now(),
        ]);

        $writter->assignRole($roleWritter);

        $moderator = User::create([
            "name" => "Enrique",
            "last_name" => "Romano",
            "email" => "enrique@gmail.com",
            "photo" => "/admin/img/foto_perfil.jpg",
            "password" => bcrypt('fer4236814'),
            "active" => true,
            "email_verified_at" => Carbon::now(),
        ]);

        $moderator->assignRole($roleModerator);

        $subscriber = User::create([
            "name" => "Nicolas Gabriel",
            "last_name" => "Romano",
            "email" => "nicolas@gmail.com",
            "photo" => "/admin/img/foto_perfil.jpg",
            "password" => bcrypt('fer4236814'),
            "active" => true,
            "email_verified_at" => Carbon::now(),
        ]);

        $subscriber->assignRole($roleSubscriber);

        $writter->givePermissionTo('Create Comments');
        $moderator->givePermissionTo('Create Comments');
        $subscriber->givePermissionTo('Create Comments');

        for ($i=0; $i < 996 ; $i++) { 
            $user = User::create([
                "name" => "Usuario de prueba " . $i,
                "last_name" => "Blog",
                "email" => "prueba@gmail.com." . $i,
                "photo" => "/admin/img/foto_perfil.jpg",
                "password" => bcrypt('fer4236814'),
                "active" => true,
                "email_verified_at" => Carbon::now(),
            ]);

            $user->assignRole($roleSubscriber);
            $user->givePermissionTo('Create Comments');
        }

    }
}
