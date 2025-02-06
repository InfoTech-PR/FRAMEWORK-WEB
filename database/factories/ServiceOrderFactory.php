<?php

namespace Database\Factories;

use App\Models\Client;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\ServiceOrder>
 */
class ServiceOrderFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'data_ordem' => fake()->date(),
            'num_os' => random_int(1, 1000),
            'cod_cliente' => Client::factory()->create(),
            'cod_navio' => random_int(1, 15),
            'valor_total' => random_int(1000, 25000),
        ];
    }
}
