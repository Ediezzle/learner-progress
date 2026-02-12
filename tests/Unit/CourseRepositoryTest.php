<?php

namespace Tests\Unit;

use App\Repositories\Course\CourseRepository;
use App\Repositories\Course\CourseRepositoryInterface;
use PHPUnit\Framework\Attributes\Test;
use ReflectionClass;
use Tests\TestCase;


class CourseRepositoryTest extends TestCase
{
     #[Test]
    public function test_concrete_class_implements_the_interface()
    {
        $this->assertContains(
            CourseRepositoryInterface::class,
            class_implements(CourseRepository::class)
        );
    }

    #[Test]
    public function test_concrete_class_has_the_required_method_signature()
    {
        $interface = new ReflectionClass(CourseRepositoryInterface::class);
        $concrete  = new ReflectionClass(CourseRepository::class);

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
        $repo = $this->app->make(
            CourseRepositoryInterface::class
        );

        $this->assertInstanceOf(
            CourseRepository::class,
            $repo
        );
    }

   
}
