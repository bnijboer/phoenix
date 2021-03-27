<?php

namespace Database\Factories;

use App\Models\Post;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Str;

class PostFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Post::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition(): array
    {
        Schema::disableForeignKeyConstraints();
        
        $title = $this->faker->sentence;

        return [
            'slug' => Str::of($title)->slug('-'),
            'title' => $title,
            'body' => $this->faker->text,
            'is_published' => true,
        ];
    }
}
