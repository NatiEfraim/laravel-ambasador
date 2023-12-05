<?php

namespace Database\Factories;

use App\Models\Link;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Order>
 */
class OrderFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        // ///get random factory
        $link = Link::inRandomOrder()->first();
        return [
            "transaction_id" => $this->faker->uuid, // Provide a UUID or another suitable value

            "code" => $link->code,
            "user_id" => $link->user->id,
            "ambassador_email" => $link->user->email,
            "first_name" => $this->faker->firstName,
            "last_name" => $this->faker->lastName,
            "email" => $this->faker->email,
            "complete" => 1
        ];
    }
}
