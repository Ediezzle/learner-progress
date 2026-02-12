<?php

namespace Tests\Unit;

use App\Models\Course;
use App\Models\Enrolment;
use App\Models\Learner;
use App\Repositories\Course\CourseRepositoryInterface;
use App\Repositories\LearnerProgress\LearnerProgressRepository;
use App\Repositories\LearnerProgress\LearnerProgressRepositoryInterface;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Cache;
use PHPUnit\Framework\Attributes\Test;
use ReflectionClass;
use Tests\TestCase;

class LearnerProgressRepositoryTest extends TestCase
{
    use RefreshDatabase;

    private CourseRepositoryInterface $courseRepo;

    private LearnerProgressRepositoryInterface $learnerRepo;

    protected function setUp(): void 
    {
         parent::setUp(); 
         Cache::flush(); 
         $this->courseRepo = app()->make(CourseRepositoryInterface::class);
         $this->learnerRepo = app()->make(LearnerProgressRepositoryInterface::class);
    }

    #[Test]
    public function test_concrete_class_implements_the_interface()
    {
        $this->assertContains(
            LearnerProgressRepositoryInterface::class,
            class_implements(LearnerProgressRepository::class)
        );
    }

    #[Test]
    public function test_concrete_class_has_the_required_method_signature()
    {
        $interface = new ReflectionClass(LearnerProgressRepositoryInterface::class);
        $concrete  = new ReflectionClass(LearnerProgressRepository::class);

        $interfaceMethods = $interface->getMethods();

        $concreteMethods  = $concrete->getMethods();

        foreach ($interfaceMethods as $interfaceMethod) {
            $concreteMethod = null;
            $found = false;
            foreach ($concreteMethods as $method) {
                if ($method->getName() === $interfaceMethod->getName()) {
                    $concreteMethod = $method;
                    $found = true;
                }
            }

            if (!$found) {
                $this->fail("Method {$interfaceMethod->getName()} not found in concrete class.");
            }

            $this->assertCount(
                count($interfaceMethod->getParameters()),
                $concreteMethod->getParameters()
            );

            $this->assertEquals(
                $interfaceMethod->getReturnType(),
                $concreteMethod->getReturnType()
            );
        }
    }

    #[Test]
    public function container_resolves_correct_repository()
    {
        $this->assertInstanceOf(
            LearnerProgressRepository::class,
            $this->learnerRepo
        );
    }

    #[Test]
    public function test_average_progress_is_calculated_correctly()
    {
        $learner = Learner::factory()->create();

        Enrolment::factory()->create([
            'learner_id' => $learner->id,
            'progress'   => 50
        ]);

        Enrolment::factory()->create([
            'learner_id' => $learner->id,
            'progress'   => 100
        ]);

        $result = $this->learnerRepo->getAllWithEnrolmentProgress(null);

        $avg = $result->first()->enrolments_avg_progress;

        $this->assertEquals(75, $avg);
    }

    #[Test]
    public function test_collection_is_returned()
    {
        Course::factory()->count(3)->create();

        $result = $this->courseRepo->getAll();

        $this->assertInstanceOf(Collection::class, $result);
    }

    #[Test]
    public function test_courses_are_returned_sorted_by_name()
    {
        Course::factory()->create(['name' => 'Zebra']);
        Course::factory()->create(['name' => 'Alpha']);
        Course::factory()->create(['name' => 'Mango']);

        $result = $this->courseRepo->getAll()->pluck('name')->values();

        $this->assertEquals(
            ['Alpha', 'Mango', 'Zebra'],
            $result->toArray()
        );
    }

    #[Test]
    public function test_results_are_stored_in_cache()
    {
        $courses = Course::factory()->count(2)->create();

        $this->courseRepo->getAll();

        $this->assertTrue(Cache::has(config('cache.course_cache_key')));

        $cachedCourses = Cache::get(config('cache.course_cache_key'));

        foreach ($courses as $course) {
            $this->assertTrue($cachedCourses->contains($course));
        }
    }

    #[Test]
    public function test_cached_result_is_returned_on_second_call()
    {
        Course::factory()->create(['name' => 'Cached Course']);

        // First call caches
        $this->courseRepo->getAll();

        // Remove from database
        Course::truncate();

        // Second call should return cached result
        $result = $this->courseRepo->getAll();

        $this->assertCount(1, $result);
        $this->assertEquals('Cached Course', $result->first()->name);
    }

    #[Test]
    public function test_cache_expires_after_one_day()
    {
        // Freeze time
        Carbon::setTestNow(now());

        Course::factory()->create(['name' => 'Initial']);

        // First call caches result
        $this->courseRepo->getAll();

        // Remove from DB
        Course::truncate();

        // Still within 1 day → should return cached value
        $this->travel(23)->hours();

        $result = $repository->getAll();
        $this->assertCount(1, $result);

        // Move beyond expiry
        $this->travel(2)->hours(); // total 25h

        $resultAfterExpiry = $repository->getAll();

        $this->assertCount(0, $resultAfterExpiry);
    }
}
