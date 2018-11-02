<?php

namespace VincentNt\ContentManager\Database\Seeds;
use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{

    public function run()
    {
        \Illuminate\Support\Facades\DB::table('admins')->insert([
            'email' => 'admin@maruweb.vn',
            'password' => bcrypt('admin1234'),
            'remember_token' => str_random(10),
            'name' => 'John Doe'
        ]);
    }
}
