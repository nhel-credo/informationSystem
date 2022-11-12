<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
use App\User;
use DB;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // default

        // User::create([
        // 	'name'	=> 'admin',
        // 	'email'	=> 'admin@mail.com',
        // 	'password'=>Hash::make('password'),
        // 	'remember_token'=> str_random(10),
        // 	]);

        DB::table('users')->insert([
            'name' => 'user1',
            'email' => 'user1@email.com',
            'password' => bcrypt('password'),
            
        ]);

        DB::table('users')->insert([
            'name' => 'user2',
            'email' => 'user2@email.com',
            'password' => bcrypt('password'),
            
        ]);
    }
}
