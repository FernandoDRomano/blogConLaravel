<?php

use App\Category;
use Illuminate\Support\Str;
use Illuminate\Database\Seeder;

class CategoriesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        for($i = 1; $i <= 20; $i++){
            $nombre = "Categoría " . $i;

            Category::create([
                "name" => $nombre,
                "url" => Str::slug($nombre)
            ]);
        }

    }
}
