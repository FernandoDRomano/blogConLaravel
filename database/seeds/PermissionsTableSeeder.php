<?php

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;

class PermissionsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        /* PERMISOS PARA LOS PERMISOS */
        Permission::create([
            "name" => "View Permissions",
            "guard_name" => "web",
            "display_name" => "Ver Permisos",
            "description" => "Con este permiso, podra ver todos los Permisos almacenados en la base de datos."
        ]);

        Permission::create([
            "name" => "Update Permissions",
            "guard_name" => "web",
            "display_name" => "Actualizar Permisos",
            "description" => "Con este permiso, podra actualizar ciertos campos de los Permisos almacenados en la base de datos."
        ]);

        /* PERMISOS PARA LOS ROLES */
        Permission::create([
            "name" => "View Roles",
            "guard_name" => "web",
            "display_name" => "Ver Roles",
            "description" => "Con este permiso, podra ver todos los Roles almacenados en la base de datos."
        ]);

        Permission::create([
            "name" => "Create Roles",
            "guard_name" => "web",
            "display_name" => "Crear Roles",
            "description" => "Con este permiso, podra crear nuevos Roles en la base de datos."
        ]);

        Permission::create([
            "name" => "Update Roles",
            "guard_name" => "web",
            "display_name" => "Actualizar Roles",
            "description" => "Con este permiso, podra actualizar ciertos campos de los Roles almacenados en la base de datos."
        ]);

        Permission::create([
            "name" => "Delete Roles",
            "guard_name" => "web",
            "display_name" => "Eliminar Roles",
            "description" => "Con este permiso, podra eliminar Roles almacenados en la base de datos."
        ]);

        /* PERMISOS PARA LOS POSTS */
        Permission::create([
            "name" => "View Posts",
            "guard_name" => "web",
            "display_name" => "Ver Posts",
            "description" => "Con este permiso, podra ver todos los Posts almacenados en la base de datos."
        ]);

        Permission::create([
            "name" => "Create Posts",
            "guard_name" => "web",
            "display_name" => "Crear Posts",
            "description" => "Con este permiso, podra crear nuevos Posts en la base de datos."
        ]);

        Permission::create([
            "name" => "Update Posts",
            "guard_name" => "web",
            "display_name" => "Actualizar Posts",
            "description" => "Con este permiso, podra actualizar los Posts almacenados en la base de datos."
        ]);

        Permission::create([
            "name" => "Delete Posts",
            "guard_name" => "web",
            "display_name" => "Eliminar Posts",
            "description" => "Con este permiso, podra eliminar Posts almacenados en la base de datos."
        ]);

        /* PERMISOS PARA LOS USUARIOS */
        Permission::create([
            "name" => "View Users",
            "guard_name" => "web",
            "display_name" => "Ver Usuarios",
            "description" => "Con este permiso, podra ver todos los Usuarios almacenados en la base de datos."
        ]);

        Permission::create([
            "name" => "Create Users",
            "guard_name" => "web",
            "display_name" => "Crear Usuarios",
            "description" => "Con este permiso, podra crear nuevos Usuarios en la base de datos."
        ]);

        Permission::create([
            "name" => "Update Users",
            "guard_name" => "web",
            "display_name" => "Actualizar Usuarios",
            "description" => "Con este permiso, podra actualizar los Usuarios almacenados en la base de datos."
        ]);

        Permission::create([
            "name" => "Delete Users",
            "guard_name" => "web",
            "display_name" => "Eliminar Usuarios",
            "description" => "Con este permiso, podra eliminar Usuarios almacenados en la base de datos."
        ]);

        /* PERMISOS PARA LOS TAGS */
        Permission::create([
            "name" => "View Tags",
            "guard_name" => "web",
            "display_name" => "Ver Etiquetas",
            "description" => "Con este permiso, podra ver todas las Etiquetas almacenadas en la base de datos."
        ]);

        Permission::create([
            "name" => "Create Tags",
            "guard_name" => "web",
            "display_name" => "Crear Etiquetas",
            "description" => "Con este permiso, podra crear nuevas Etiquetas en la base de datos."
        ]);

        Permission::create([
            "name" => "Update Tags",
            "guard_name" => "web",
            "display_name" => "Actualizar Etiquetas",
            "description" => "Con este permiso, podra actualizar las Etiquetas almacenadas en la base de datos."
        ]);

        Permission::create([
            "name" => "Delete Tags",
            "guard_name" => "web",
            "display_name" => "Eliminar Etiquetas",
            "description" => "Con este permiso, podra eliminar Etiquetas almacenadas en la base de datos."
        ]);

        /* PERMISOS PARA LAS CATEGORIES */
        Permission::create([
            "name" => "View Categories",
            "guard_name" => "web",
            "display_name" => "Ver Categorías",
            "description" => "Con este permiso, podra ver todas las Categorías almacenadas en la base de datos."
        ]);

        Permission::create([
            "name" => "Create Categories",
            "guard_name" => "web",
            "display_name" => "Crear Categorías",
            "description" => "Con este permiso, podra crear nuevas Categorías en la base de datos."
        ]);

        Permission::create([
            "name" => "Update Categories",
            "guard_name" => "web",
            "display_name" => "Actualizar Categorías",
            "description" => "Con este permiso, podra actualizar las Categorías almacenadas en la base de datos."
        ]);

        Permission::create([
            "name" => "Delete Categories",
            "guard_name" => "web",
            "display_name" => "Eliminar Categorías",
            "description" => "Con este permiso, podra eliminar Categorías almacenados en la base de datos."
        ]);

        /* PERMISOS PARA LAS COMMENTS */
        Permission::create([
            "name" => "View Comments",
            "guard_name" => "web",
            "display_name" => "Ver Comentarios",
            "description" => "Con este permiso, podra ver todos los Comentarios almacenados en la base de datos."
        ]);

        Permission::create([
            "name" => "Create Comments",
            "guard_name" => "web",
            "display_name" => "Crear Comentarios",
            "description" => "Con este permiso, podra crear nuevos Comentarios en la base de datos."
        ]);

        Permission::create([
            "name" => "Update Comments",
            "guard_name" => "web",
            "display_name" => "Actualizar Comentarios",
            "description" => "Con este permiso, podra actualizar los Comentarios almacenados en la base de datos."
        ]);

        Permission::create([
            "name" => "Delete Comments",
            "guard_name" => "web",
            "display_name" => "Eliminar Comentarios",
            "description" => "Con este permiso, podra eliminar Comentarios almacenados en la base de datos."
        ]);

    }
}
