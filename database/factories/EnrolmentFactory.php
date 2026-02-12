<?php

namespace Database\Factories;

use App\Models\Enrolment;
use App\Models\Learner;
use App\Models\Course;
use Illuminate\Database\Eloquent\Factories\Factory;

class EnrolmentFactory extends Factory
{
    protected $model = Enrolment::class;

    public function definition()
    {
        return [
            'learner_id' => Learner::factory(),
            'course_id' => Course::factory(),
            'progress' => $this->faker->numberBetween(0, 100),
        ];
    }
}
