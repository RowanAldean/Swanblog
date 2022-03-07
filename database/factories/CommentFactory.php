<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Comment>
 */
class CommentFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            //The post_id will be given using the hasComments method which infers the relationship in our seeder.
            //Similarly the timestamps are inferred based on instance creation.
            'body' => $this->faker->realText(), //Use a random real text string
            'user_id' => User::get()->random()->id, //Use a random user for each comment
        ];
    }
}
