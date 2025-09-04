<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Package>
 */
class PackageFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {

        $faker = \Faker\Factory::create('fa_IR');


        return [
            'package_title'       => $faker->words(2, true), // دو کلمه فارسی
            'package_description' => $faker->paragraph(),    // توضیح فارسی
            'package-category'    => 0,
            'package_price'       => $faker->randomFloat(2, 1000, 10000), // قیمت بین ۱۰۰۰ تا ۱۰۰۰۰
            'package_uuid'        => Str::uuid(),
        ];
    }
}
