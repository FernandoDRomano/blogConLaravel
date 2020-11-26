<?php

use App\Tag;
use Illuminate\Support\Str;
use Illuminate\Database\Seeder;

class TagsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for($i = 1; $i <= 20; $i++){
            $nombre = "Tag " . $i;

            Tag::create([
                "name" => $nombre,
                "url" => Str::slug($nombre)
            ]);
        }
    }
}
