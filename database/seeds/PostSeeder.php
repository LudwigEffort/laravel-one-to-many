<?php

use App\Tag;
use App\Post;
use App\Category;
use Illuminate\Http\File;
use Faker\Generator as Faker;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Storage;

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

        $tags = Tag::all()->pluck('id'); // il metodo pluck ci restituisce un array con gli id dei tags

        $tagCount = count($tags); // contiamo il numero di tags

        for ($i=0; $i < 1000; $i++) {
            $title = $faker->words(rand(3, 7), true);

            $post = Post::create([
                'category_id' => $faker->randomElement($categories)->id, // cosi preandiamo casualmente gli id degli elementi della variablile (in questo caso le categorie)
                'slug'          => Post::getSlug($title),
                'title'         => $title,
                'image'         => 'https://picsum.photos/id/'. rand(0, 1000) . '/500/400',
                'content'       => $faker->paragraphs(rand(1, 10), true),
                'excerpt'       => $faker->paragraphs(1, true),
            ]);

            // questa tabella scrive nella tabella ponte
            $post->tags()->attach($faker->randomElements($tags, rand(0, ($tagCount > 10) ? 10 : $tagCount)));
        }
    }
}
