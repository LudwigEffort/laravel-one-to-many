<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Storage;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // $this->call(UserSeeder::class);
        Storage::deleteDirectory('uploads');
        Storage::makeDirectory('uploads');
        $this->call(UserSeeder::class);
        $this->call(CategorySeeder::class);
        $this->call(PostSeeder::class);
    }
}
