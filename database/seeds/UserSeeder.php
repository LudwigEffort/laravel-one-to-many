<?php

use App\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $users = [
            //user1
            [
                'name' => 'enrico',
                'email' => 'enrico.fermi@gmail.com',
                'password' => Hash::make('password'),
            ],
            //user2
            [
                'name' => 'werner',
                'email' => 'werner.heisenberg@gmail.com',
                'password' => Hash::make('password'),
            ],
            //user3
            [
                'name' => 'albert',
                'email' => 'albert.einstein@gmail.com',
                'password' => Hash::make('password'),
            ],
        ];

        foreach ($users as $user) {
            User::create($user);
        }
    }
}
