<?php

namespace Database\Seeders;

use App\Models\Post;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $user =  \App\Models\User::factory()->count(10)->create();

        $posts = Post::factory()->count(25)->create();
//         \App\Models\Admin::factory()->count(1)->create();
//        factory(User::class,10)->create();
        $this->call([
           AdminTableSeeder::class,
        ]);

    }
}
