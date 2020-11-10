<?php

use App\User;
use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            "name" => "Fernando Daniel",
            "last_name" => "Romano",
            "email" => "fernando@gmail.com",
            "password" => bcrypt('fer4236814'),
            "role_id" => 1
        ]);

        User::create([
            "name" => "Evangelina",
            "last_name" => "Ibarra",
            "email" => "eva@gmail.com",
            "password" => bcrypt('fer4236814'),
            "role_id" => 2
        ]);

        User::create([
            "name" => "Nicolas Gabriel",
            "last_name" => "Romano",
            "email" => "nicolas@gmail.com",
            "password" => bcrypt('fer4236814'),
            "role_id" => 3
        ]);
    }
}
