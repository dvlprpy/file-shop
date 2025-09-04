<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Plan>
 */
class PlanFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {

        $faker = \Faker\Factory::create('fa_IR'); // برای داده‌های فارسی

        
        return [
            'plan_uuid'           => Str::uuid(),
            'plan_title'          => $faker->words(2, true), // عنوان فارسی 2 کلمه‌ای
            'plan_download_limit' => $faker->numberBetween(10, 100), // تعداد دانلود بین 10 تا 100
            'plan_price'          => $faker->randomFloat(2, 5000, 20000), // قیمت بین 5000 تا 20000
            'plan_day'            => $faker->numberBetween(7, 365), // تعداد روز اعتبار بین 7 تا 365
        ];
    }
}
