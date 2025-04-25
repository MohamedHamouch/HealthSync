<?php

namespace Database\Factories;

use App\Models\HealthRecord;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\HealthRecord>
 */
class HealthRecordFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = HealthRecord::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'user_id' => User::factory(),
            'title' => $this->faker->sentence(3),
            'description' => $this->faker->paragraph(2),
            'record_date' => $this->faker->dateTimeBetween('-1 year', 'now'),
            'blood_pressure_systolic' => $this->faker->optional(0.8)->numberBetween(100, 180),
            'blood_pressure_diastolic' => $this->faker->optional(0.8)->numberBetween(60, 120),
            'respiration_rate' => $this->faker->optional(0.7)->numberBetween(12, 25),
            'blood_sugar' => $this->faker->optional(0.6)->numberBetween(70, 180),
            'pulse_rate' => $this->faker->optional(0.8)->numberBetween(60, 100),
            'temperature' => $this->faker->optional(0.7)->randomFloat(1, 36.0, 38.5),
            'weight' => $this->faker->optional(0.7)->randomFloat(1, 50, 120),
            'oxygen_saturation' => $this->faker->optional(0.6)->numberBetween(90, 100),
        ];
    }
} 