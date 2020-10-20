<?php

use Illuminate\Database\Seeder;
use \App\User;
use Illuminate\Support\Str;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = User::create([
            'name' => 'Admin',
            'email' => 'admin@mail.com',
            'email_verified_at' => now(),
            'password' => bcrypt('password'),
            'api_token' => Str::random(60),
        ]);

        $user->assignRole('admin');
    }
}
