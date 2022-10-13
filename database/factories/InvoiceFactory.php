<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Invoice>
 */
class InvoiceFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        $base = $this->faker->randomFloat(2, 0, 1000);
        $iva = $base * 0.21;
        $total = $base + $iva;

        return [
            'serie' => $this->faker->randomElement(['F001', 'B001']),
            // 'correlative' => $this->faker->randomNumber(6),
            'base' => $base,
            'iva' => $iva,
            'total' => $total,
            'user_id' => User::all()->random()->id,
        ];
    }
}
