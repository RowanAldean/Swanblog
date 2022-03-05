<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\User>
 */
class UserFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        $firstName = $this->faker->firstName();
        $secondName = $this->faker->lastName();
        return [
            'name' => $firstName . " " . $secondName,
            'username' => $this->faker->unique()->userName(),
            'email' => strtolower($firstName) . "." . strtolower($secondName) . "@swanblog.test",
            'email_verified_at' => now(),
            'password' => 'helloworld', // password
            'remember_token' => Str::random(10),
        ];
    }

    /**
     * Indicate that the model's email address should be unverified.
     *
     * @return static
     */
    public function unverified()
    {
        return $this->state(function (array $attributes) {
            return [
                'email_verified_at' => null,
            ];
        });
    }
}
