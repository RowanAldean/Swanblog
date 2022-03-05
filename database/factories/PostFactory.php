<?php

namespace Database\Factories;

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

            // $table->bigIncrements('id');
            // $table->unsignedBigInteger('user_id');
            // $table->longText('caption');
            // $table->string('image');
            // $table->bigInteger('likes')->default(0);
            // $table->timestamps();

            // $table->index('user_id');
            'caption' => $this->faker->sentence(rand(8, 20)),
            'user_id' => User::all()->random()->id,
        ];
    }
}
