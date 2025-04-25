<?php

namespace Database\Factories;

use App\Models\Client;
use App\Models\Doctor;
use Illuminate\Database\Eloquent\Factories\Factory;

class ClientDoctorFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $now = now();
        // Random expiration between 3 months and 1 year from now
        $expiresAt = fake()->dateTimeBetween(
            $now->copy()->addMonths(3)->format('Y-m-d'),
            $now->copy()->addYear()->format('Y-m-d')
        );

        return [
            'client_id' => Client::inRandomOrder()->first()->id,
            'doctor_id' => Doctor::inRandomOrder()->first()->id,
            'access_granted_at' => now(),
            'access_expires_at' => $expiresAt,
            'is_active' => true,
        ];
    }

    /**
     * Make the relationship inactive
     */
    public function inactive(): static
    {
        return $this->state(function (array $attributes) {
            return [
                'is_active' => false,
            ];
        });
    }

    /**
     * Make the relationship expired
     */
    public function expired(): static
    {
        return $this->state(function (array $attributes) {
            return [
                'access_expires_at' => fake()->dateTimeBetween('-3 months', '-1 day'),
                'is_active' => false,
            ];
        });
    }
} 