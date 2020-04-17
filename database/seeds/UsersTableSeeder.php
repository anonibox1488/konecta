<?php

use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Seeder;
use App\User;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::truncate();
        User::create([
            'email' => 'admin@mail.com',
            'password' => Hash::make('123456'),
            'name' => 'Jose Torrealba',
            'role' => 'admin',
        ]);
        User::create([
            'email' => 'seller@mail.com',
            'password' => Hash::make('123456'),
            'name' => 'Gregorio Torrealba',
            'role' => 'seller',
        ]);   
    }
}
