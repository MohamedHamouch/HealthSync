<?php

namespace Database\Factories;

use App\Enums\AppointmentStatus;
use App\Models\Appointment;
use App\Models\AppointmentSlot;
use App\Models\Client;
use App\Models\Doctor;
use Illuminate\Database\Eloquent\Factories\Factory;

class AppointmentFactory extends Factory
{
    protected $model = Appointment::class;

    public function definition(): array
    {
        $status = fake()->randomElement(AppointmentStatus::cases());
        
        return [
            'doctor_id' => Doctor::inRandomOrder()->first()->id,
            'client_id' => Client::inRandomOrder()->first()->id,
            'appointment_slot_id' => AppointmentSlot::where('is_available', true)->inRandomOrder()->first()?->id,
            'reason' => fake()->sentence(10),
            'status' => $status,
            'notes' => $status === AppointmentStatus::COMPLETED ? fake()->paragraph() : null,
        ];
    }

    /**
     * Configure the appointment as pending
     */
    public function pending(): static
    {
        return $this->state(function (array $attributes) {
            return [
                'status' => AppointmentStatus::PENDING,
                'notes' => null,
            ];
        });
    }

    /**
     * Configure the appointment as confirmed
     */
    public function confirmed(): static
    {
        return $this->state(function (array $attributes) {
            return [
                'status' => AppointmentStatus::CONFIRMED,
                'notes' => fake()->sentence(),
            ];
        });
    }

    /**
     * Configure the appointment as completed
     */
    public function completed(): static
    {
        return $this->state(function (array $attributes) {
            return [
                'status' => AppointmentStatus::COMPLETED,
                'notes' => fake()->paragraph(),
            ];
        });
    }
} 