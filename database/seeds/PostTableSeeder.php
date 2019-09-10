<?php

use App\Post;
use Illuminate\Database\Seeder;

class PostTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker\Factory::create();

        for ($i=0; $i<50; $i++) {
            Post::create([
                'title' => $faker->sentence(3),
                'body' => $faker->paragraph(6),
                'tags' => join(',', $faker->words(4))
            ]);
        }
    }
}
