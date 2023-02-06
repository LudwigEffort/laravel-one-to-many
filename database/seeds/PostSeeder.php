<?php

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

        for ($i=0; $i < 1000; $i++) {
            $title = $faker->words(rand(3, 7), true);

            // $number = rand(0, 276);
            // if ($number) {

            //     $contents = new File(__DIR__ . '/../../storage/app/lorempicsum' . $number . '.jpg');

            //     $img_paht = Storage::put('uploads');

            // } else {
            //     $img_paht = null;
            // }


            //$loremImages = Storage::files('lorempicsum');
            //$img_path = Storage::put('uploads', $faker->randomElement($loremImages)); //TODO: risolvere il problema dei permessi delle img

            Post::create([
                'category_id' => $faker->randomElement($categories)->id, // cosi preandiamo casualmente gli id degli elementi della variablile (in questo caso le categorie)
                'slug'          => Post::getSlug($title),
                'title'         => $title,
                'image'         => 'https://picsum.photos/id/'. rand(0, 1000) . '/500/400',
                //'uploaded_img'  => $img_path,
                'content'       => $faker->paragraphs(rand(1, 10), true),
                'excerpt'       => $faker->paragraphs(1, true),
            ]);
        }
    }
}
