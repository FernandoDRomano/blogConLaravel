<?php

use App\Post;
use Carbon\Carbon;
use Illuminate\Support\Str;
use Illuminate\Database\Seeder;

class PostsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        for($i = 1; $i <= 10; $i++){
            $nombre = "Post " . $i;

            Post::create([
                'title' => $nombre,
                'published_at' => Carbon::now(),
                'extract' => 'Este es un extracto ' . $i,
                'body' => 'body ' . $i,
                'approved' => false,
                'url' => Str::slug($nombre),
                'user_id' => 2,
                'category_id' => 1
             ]);
        }

    }
}
