<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Profile>
 */
class ProfileFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            // We use this factory to produce a profile when each user is created in the UsersTableSeeder via "magic methods".
            'bio' => $this->faker->realText($maxNbChars = 100),
            'website' => $this->faker->url(),
            'image' => "https://i.pravatar.cc/300?u=" . $this->faker->userName(),
        ];
    }
}
