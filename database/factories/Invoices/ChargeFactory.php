<?php

namespace Database\Factories\Invoices;

use App\Models\Invoice\Encounter;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Invoices\Charge>
 */
class ChargeFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'encounter'     => Encounter::class,
            'code'          => fake()->randomNumber(5),
            'codeText'      => fake()->text(64),
            'fee'           => fake()->randomNumber(4),
            'copay'         => fake()->randomNumber(2),
            'units'         => fake()->randomNumber(1),
        ];
    }
}
