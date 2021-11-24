<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    public function run()
    {
        //
        User::create([
            'first_name' => 'Mario',
            'last_name' => 'Mamdouh',
            'email' => 'mario@gmail.com',
            'password' => bcrypt('mario237')
        ]);
    }
}
