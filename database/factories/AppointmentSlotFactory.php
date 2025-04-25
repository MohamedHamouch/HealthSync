<?php

namespace Database\Factories;

use App\Models\Doctor;
use App\Models\AppointmentSlot;
use Illuminate\Database\Eloquent\Factories\Factory;

class AppointmentSlotFactory extends Factory
{
    protected $model = AppointmentSlot::class;

    public function definition(): array
    {
        // Generate a start time during working hours
        $startTime = fake()->dateTimeBetween('+1 day', '+2 weeks');
        $hour = rand(8, 16); // Between 8 AM and 4 PM
        $minute = [0, 30][rand(0, 1)]; // Either 0 or 30 minutes
        $startTime->setTime($hour, $minute, 0);
        
        // Create end time 30 minutes after start
        $endTime = clone $startTime;
        $endTime->modify('+30 minutes');

        return [
            'doctor_id' => Doctor::inRandomOrder()->first()->id,
            'start_time' => $startTime,
            'end_time' => $endTime,
            'is_available' => true,
        ];
    }

    /**
     * Set slot as unavailable
     */
    public function unavailable(): static
    {
        return $this->state(fn (array $attributes) => [
            'is_available' => false,
        ]);
    }
} 