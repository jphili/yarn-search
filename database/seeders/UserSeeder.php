<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        \App\Models\User::factory(4)->create();
        // for ($i = 0; $i<3; $i++) {
        //     User::create([
        //         'email' => Str::random(10).'@test.com',
        //         'username' => Str::random(8),
        //         'password' => Hash::make('password'),
        //     ]);
        // }
    }
}
