<?php

namespace Tests\Unit;

use App\Models\Enrolment;
use App\Models\Learner;
use App\Models\Course;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use PHPUnit\Framework\Attributes\Test;


class EnrolmentTest extends TestCase
{
    use RefreshDatabase;
    
    #[Test]
    public function test_enrolment_belongs_to_learner_and_course()
    {
        $learner = Learner::factory()->create();
        $course = Course::factory()->create();
        $enrolment = Enrolment::factory()->create([
            'learner_id' => $learner->id,
            'course_id' => $course->id,
            'progress' => 75
        ]);
        $this->assertEquals($enrolment->learner->is($learner), true);
        $this->assertEquals($enrolment->course->is($course), true);
    }

    #[Test]
    public function test_progress_casting()
    {
        $enrolment = Enrolment::factory()->create(['progress' => 88]);
        $this->assertEquals('88.00', strval($enrolment->progress));
    }
}
