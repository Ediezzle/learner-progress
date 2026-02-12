<?php

namespace Tests\Unit;

use App\Models\Course;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class CourseTest extends TestCase
{
    use RefreshDatabase;

    public function test_course_can_be_created()
    {
        Course::factory()->create(['name' => 'Mathematics']);
        $this->assertDatabaseHas('courses', ['name' => 'Mathematics']);
    }
}
