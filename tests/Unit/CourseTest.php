<?php

namespace Tests\Unit;

use App\Models\Course;
use PHPUnit\Framework\Attributes\Test;

use Tests\TestCase;

class CourseTest extends TestCase
{
    #[Test]
    public function test_course_can_be_created()
    {
        Course::factory()->create(['name' => 'Mathematics']);
        $this->assertDatabaseHas('courses', ['name' => 'Mathematics']);
    }
}
