<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\User>
 */
class UserFactory extends Factory
{
    /**
     * The current password being used by the factory.
     */
    protected static ?string $password;

    
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {

        
        $faker = \Faker\Factory::create('fa_IR');


        return [
            'fullname' => $faker->name(),
            'username' => $faker->userName(),
            'password' => bcrypt('password'),
            'phone' => '09'.$faker->numerify('#########'),
            'wallet'   => $this->faker->randomFloat(2, 0, 1000),
            'role'     => $this->faker->randomElement(['normaluser','seller','adminsystem']),
            'email' => $faker->unique()->safeEmail(),
            'remember_token' => Str::random(10),
            
        ];
    }

    /**
     * Indicate that the model's email address should be unverified.
     */
    public function unverified(): static
    {
        return $this->state(fn (array $attributes) => [
            'email_verified_at' => null,
        ]);
    }
}
