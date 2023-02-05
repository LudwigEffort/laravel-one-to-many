<?php

use App\Category;
use App\Post;
//use Illuminate\Support\Str;
use Faker\Generator as Faker;
use Illuminate\Database\Seeder;

class PostSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(Faker $faker)
    {
        $categories = Category::all('id')->all(); // con qusta stringa selezioniamo gli id delle categorie dal db

        for ($i=0; $i < 100; $i++) {
            $title = $faker->words(rand(3, 7), true);
            Post::create([
                'category_id' => $faker->randomElement($categories)->id, // cosi preandiamo casualmente gli id degli elementi della variablile (in questo caso le categorie)
                'slug'    => Post::getSlug($title),
                'title'   => $title,
                'image'   => 'https://picsum.photos/id/'. rand(0, 1000) . '/500/400',
                'content' => $faker->paragraphs(rand(1, 10), true),
                'excerpt' => $faker->paragraphs(1, true),
            ]);
        }
    }
}
