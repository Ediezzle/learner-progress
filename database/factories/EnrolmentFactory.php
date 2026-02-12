<?php

namespace Database\Factories;

use App\Models\Learner;
use App\Models\Course;
use Illuminate\Database\Eloquent\Factories\Factory;

class EnrolmentFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition(): array
    {
        return [
            'learner_id' => Learner::factory(),
            'course_id' => Course::factory(),
            'progress' => $this->faker->numberBetween(0, 100),
        ];
    }
}
