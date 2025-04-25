<?php

namespace Database\Factories;

use App\Enums\AppointmentStatus;
use App\Models\Appointment;
use App\Models\Review;
use Illuminate\Database\Eloquent\Factories\Factory;

class ReviewFactory extends Factory
{
    protected $model = Review::class;

    public function definition(): array
    {
        return [
            'appointment_id' => Appointment::where('status', AppointmentStatus::COMPLETED)
                ->doesntHave('review')
                ->inRandomOrder()
                ->first()?->id,
            'rating' => fake()->numberBetween(3, 5),
            'comment' => fake()->paragraph(),
        ];
    }

    /**
     * Create a negative review with low rating
     */
    public function negative(): static
    {
        return $this->state(function (array $attributes) {
            return [
                'rating' => fake()->numberBetween(1, 2),
                'comment' => 'The experience was disappointing. ' . fake()->paragraph(),
            ];
        });
    }

    /**
     * Create a positive review with high rating
     */
    public function positive(): static
    {
        return $this->state(function (array $attributes) {
            return [
                'rating' => fake()->numberBetween(4, 5),
                'comment' => 'Excellent experience! ' . fake()->paragraph(),
            ];
        });
    }
} 