<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Post;
use App\Models\Article;
use App\Models\Category;
use App\Models\Comment;
use App\Models\User;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);

        Post::factory()->count(10)->create();
        Article::factory(20)->create();
        
        $list = ['Tech', 'Sport', 'World', 'Music', 'Crime'];

        foreach($list as $name){
            Category::create([
                'name' => $name,
            ]);
        }

        Comment::factory()->count(60)->create();

        User::factory()->create([
            'name' => 'Alice',
            'email'=> "alice@gmail.com",
        ]);

        User::factory()->create([
            'name' => 'Bob',
            'email' => 'bob@gmail.com',
        ]);

    }
}
