<?php

namespace Tests\Feature;

use App\Models\Learner;
use App\Models\Course;
use App\Models\Enrolment;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class LearnerProgressControllerTest extends TestCase
{
    use RefreshDatabase;

    public function test_index_displays_learners()
    {
        $learner = Learner::factory()->create(['firstname' => 'Alice', 'lastname' => 'Wonder']);
        $course = Course::factory()->create(['name' => 'Biology']);
        Enrolment::factory()->create([
            'learner_id' => $learner->id,
            'course_id' => $course->id,
            'progress' => 60
        ]);

        $response = $this->get(route('learner-progress.index'));
        $response->assertStatus(200);
        $response->assertSee('Alice');
        $response->assertSee('Wonder');
    }

    public function test_index_filters_by_course()
    {
        $learner1 = Learner::factory()->create(['firstname' => 'Bob', 'lastname' => 'Builder']);
        $learner2 = Learner::factory()->create(['firstname' => 'Charlie', 'lastname' => 'Chaplin']);
        $course1 = Course::factory()->create(['name' => 'Math']);
        $course2 = Course::factory()->create(['name' => 'History']);
        Enrolment::factory()->create([
            'learner_id' => $learner1->id,
            'course_id' => $course1->id,
            'progress' => 80
        ]);
        Enrolment::factory()->create([
            'learner_id' => $learner2->id,
            'course_id' => $course2->id,
            'progress' => 90
        ]);

        $response = $this->get(route('learner-progress.index', ['course_id' => $course1->id]));
        $response->assertStatus(200);
        $response->assertSee('Bob');
        $response->assertDontSee('Charlie');
    }

    public function test_index_sorts_by_progress()
    {
        $learner1 = Learner::factory()->create(['firstname' => 'Daisy', 'lastname' => 'Duck']);
        $learner2 = Learner::factory()->create(['firstname' => 'Elmo', 'lastname' => 'Sesame']);
        $course = Course::factory()->create(['name' => 'Physics']);
        Enrolment::factory()->create([
            'learner_id' => $learner1->id,
            'course_id' => $course->id,
            'progress' => 20
        ]);
        Enrolment::factory()->create([
            'learner_id' => $learner2->id,
            'course_id' => $course->id,
            'progress' => 90
        ]);

        $response = $this->get(route('learner-progress.index', ['sort_direction' => 'desc']));
        $response->assertStatus(200);
        $response->assertSeeInOrder(['Elmo', 'Daisy']);
    }
}
