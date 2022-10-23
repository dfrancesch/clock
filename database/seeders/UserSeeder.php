<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use App\Models\User;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        # admin@example.com
        User::updateOrCreate(
            ['id' => 1],
            [
                'name'                  => 'Daniel',
                'last_name'             => 'Francesch',
                'nick_name'             => 'Mago Capote',
                'email'                 => 'daniel.francesch@gmail.com',
                'email_verified_at'     => now(),
                'password'              => Hash::make('password'),
                'photo'                 => null,
                'gender'                => null,
                'remember_token'        => Str::random(10),
                'last_login'            => null,
            ]
        );
    }
}
