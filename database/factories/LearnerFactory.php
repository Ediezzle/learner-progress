<?php

namespace Database\Factories;

use App\Models\Learner;
use Illuminate\Database\Eloquent\Factories\Factory;

class LearnerFactory extends Factory
{
    protected $model = Learner::class;

    public function definition()
    {
        return [
            'firstname' => $this->faker->firstName,
            'lastname' => $this->faker->lastName,
        ];
    }
}
