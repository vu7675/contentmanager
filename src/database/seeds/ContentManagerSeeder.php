<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Faker\Generator as Faker;

class ContentManagerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('admins')->insert([
            'name' => 'Admin',
            'email' => 'admin@maruweb.vn',
            'password' => bcrypt('admin1234'),
            'remember_token' => str_random(10)
        ]);
        DB::table('users')->insert([
            'name' => 'John Doe',
            'email' => 'user@maruweb.vn',
            'email_verified_at' => now(),
            'password' => '$2y$10$TKh8H1.PfQx37YgCzwiKb.KjNyWgaHb9cbcoQgdIVFlYg7B77UdFm', // secret
            'remember_token' => str_random(10),
        ]);
        factory(App\User::class, 10)->create();
    }
}
