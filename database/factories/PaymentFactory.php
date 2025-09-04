<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use App\Models\User;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Payment>
 */
class PaymentFactory extends Factory
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
            'payment_user_id'   => User::inRandomOrder()->first()->user_id, // انتخاب یک کاربر تصادفی
            'payment_method'    => $faker->randomElement(['wallet', 'card']),
            'payment_amount'    => $faker->randomFloat(2, 1000, 10000),
            'payment_bank_name' => $faker->company(),
            'payment_res_num'   => $faker->unique()->numerify('##########'),
            'payment_ref_num'   => $faker->unique()->numerify('##########'),
            'payment_status'    => $faker->randomElement(['complete','incomplete']),
            'payment_created_at'=> now(),
            'payment_updated_at'=> now(),
        ];
    }
}
