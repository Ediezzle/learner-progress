<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Models\Learner;
use App\Models\Course;
use App\Models\Enrolment;
use PHPUnit\Framework\Attributes\Test;

class LearnerProgressUiTest extends TestCase
{
    use RefreshDatabase;

    #[Test]
    public function test_learner_progress_index_page_loads_successfully()
    {
        $response = $this->get(route('learner-progress.index'));
        $response->assertStatus(200);
        $response->assertViewIs('learner-progress.index');
    }

    #[Test]
    public function test_learner_progress_index_displays_learners()
    {
        $learner = Learner::factory()->create();
        $response = $this->get(route('learner-progress.index'));
        $response->assertSee($learner->full_name);
    }

    #[Test]
    public function test_learner_progress_show_page_loads_successfully()
    {
        $learner = Learner::factory()->create();
        $response = $this->get(route('learner-progress.show', $learner));
        $response->assertStatus(200);
        $response->assertViewIs('learner-progress.show');
    }

    #[Test]
    public function test_learner_progress_show_displays_enrolments()
    {
        $learner = Learner::factory()->create();
        $course = Course::factory()->create();
        Enrolment::factory()->create([
            'learner_id' => $learner->id,
            'course_id' => $course->id,
            'progress' => 50,
        ]);
        $response = $this->get(route('learner-progress.show', $learner));
        $response->assertSee($course->name);
        $response->assertSee('50');
    }
}
