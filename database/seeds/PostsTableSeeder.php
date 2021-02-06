<?php

use App\Post;
use App\Comment;
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

        for($i = 1; $i <= 1000; $i++){
            $nombre = "Post " . $i;

            Post::create([
                'title' => $nombre,
                'published_at' => Carbon::now(),
                'extract' => 'Este es un extracto ' . $i,
                'body' => 'body ' . $i,
                'approved' => true,
                'url' => Str::slug($nombre),
                'user_id' => 2,
                'category_id' => 1
             ]);
        }

        for ($i=0; $i < 1000; $i++) { 
            Comment::create([
                'body' => 'Este es el comentario #' . $i,
                'user_id' => rand(1, 1000),
                'post_id' => rand(1, 1000),
            ]);
        }

    }
}
