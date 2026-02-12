<?php

namespace Tests\Unit;

use Tests\TestCase;
use App\Models\Course;
use App\Models\Learner;
use App\Models\Enrolment;
use PHPUnit\Framework\Attributes\Test;

class LearnerTest extends TestCase
{
    #[Test]
    public function test_full_name_accessor_returns_concatenated_name()
    {
        $learner = Learner::factory()->create(['firstname' => 'Jane', 'lastname' => 'Doe']);
        $this->assertEquals('Jane Doe', $learner->full_name);
    }

    #[Test]
    public function test_enrolments_relationship()
    {
        $learner = Learner::factory()->create();
        $course = Course::factory()->create();
        $enrolment = Enrolment::factory()->create([
            'learner_id' => $learner->id,
            'course_id' => $course->id,
            'progress' => 50
        ]);
        $this->assertTrue($learner->enrolments->contains($enrolment));
    }
}
