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
        DB::table('categories')->insert([
            [
                'name' => 'Tin tức',
                'slug' => str_slug('Tin tức'),
                'cover' => '/images/category/1.jpg',
                'meta-description' => str_slug('Tin tức'),
            ],
            [
                'name' => 'Sức khoẻ',
                'slug' => str_slug('Sức khoẻ'),
                'cover' => '/images/category/1.jpg',
                'meta-description' => str_slug('Sức khoẻ'),
            ],
            [
                'name' => 'Đời sống',
                'slug' => str_slug('Đời sống'),
                'cover' => '/images/category/1.jpg',
                'meta-description' => str_slug('Đời sống'),
            ],
        ]);
        $posts = factory(App\Post::class, 100)->create();
        foreach ($posts as $post) {
            DB::table('post_category')->insert([
                'post_id' => $post->id,
                'category_id' => rand(1,3),
            ]);
        }
        factory(App\Page::class, 3)->create();
    }
}
