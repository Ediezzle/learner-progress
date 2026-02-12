<?php

namespace Tests\Unit;

use App\Models\Course;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Cache;
use PHPUnit\Framework\Attributes\Test;
use Tests\TestCase;

class CourseObserverTest extends TestCase
{
    use RefreshDatabase;

    private string $cacheKey;

    protected function setUp(): void 
    {
         parent::setUp(); 
         Cache::flush(); 
         $this->cacheKey = config('cache.course_cache_key');
    }

    #[Test]
    public function test_cache_is_cleared_when_course_is_created()
    {
        $key = $this->cacheKey;

        Cache::put($key, collect(['dummy']), now()->addDay());

        $this->assertTrue(Cache::has($key));

        Course::factory()->create();

        $this->assertFalse(Cache::has($key));
    }

    #[Test]
    public function test_cache_is_cleared_when_course_is_updated()
    {
        $key = $this->cacheKey;

        $course = Course::factory()->create();

        Cache::put($key, collect(['dummy']), now()->addDay());

        $this->assertTrue(Cache::has($key));

        $course->update(['name' => 'Updated']);

        $this->assertFalse(Cache::has($key));
    }

    #[Test]
    public function test_cache_is_cleared_when_course_is_deleted()
    {
        $key = $this->cacheKey;

        $course = Course::factory()->create();

        Cache::put($key, collect(['dummy']), now()->addDay());

        $this->assertTrue(Cache::has($key));

        $course->delete();

        $this->assertFalse(Cache::has($key));
    }
}
