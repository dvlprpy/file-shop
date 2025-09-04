<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\File>
 */
class FileFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'file_title'         => $this->faker->sentence,
            'file-category'      => 0,
            'file_original_name' => $this->faker->word . '.pdf',
            'file_description'   => $this->faker->paragraph,
            'file_type'          => 'pdf',
            'file_size'          => $this->faker->randomFloat(2, 100, 5000),
            'file_hash'          => $this->faker->sha256,
            'path'               => 'uploads/' . $this->faker->uuid . '.pdf',
            'visibility'         => $this->faker->randomElement(['public', 'private']),
        ];
    }
}
