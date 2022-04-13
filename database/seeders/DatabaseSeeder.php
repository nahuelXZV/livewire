<?php

namespace Database\Seeders;

use App\Models\Post;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Storage;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        Storage::deleteDirectory('posts');
        Storage::makeDirectory('posts');
        User::create([
            'name' => "Nahuel Zalazar",
            'email' => "NahuelZalazar@gmail.com",
            'password' => bcrypt('12345678')
        ]);
        Post::factory(100)->create();
    }
}
