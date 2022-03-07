<?php

namespace Database\Factories;

use App\Models\Post;
use App\Models\Like;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Post>
 */
class PostFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            //All other attributes of a Post instance can be inferred using the nested seeding and Magic Methods.
            'caption' => $this->faker->sentence(rand(8, 20)),
        ];
    }
}
