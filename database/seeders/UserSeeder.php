<?php

namespace Database\Seeders;

use App\Models\Post;
use App\Models\User;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::factory()
            ->admin()
            ->create();

        User::factory()
            ->editor()
            ->has(Post::factory()->count(10))
            ->create();
            
        User::factory()->create();
    }
}
