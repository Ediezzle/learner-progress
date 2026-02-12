<?php

namespace Tests\Unit;

use App\Models\Enrolment;
use App\Observers\EnrolmentObserver;
use InvalidArgumentException;
use Tests\TestCase;
use PHPUnit\Framework\Attributes\Test;

class EnrolmentObserverTest extends TestCase
{
    #[Test]
    public function test_validate_progress_throws_for_invalid_progress()
    {
        $observer = new EnrolmentObserver();
        $enrolment = new Enrolment(['progress' => 150]);
        $this->expectException(InvalidArgumentException::class);
        $observer->updating($enrolment);
    }

    #[Test]
    public function test_validate_progress_allows_valid_progress()
    {
        $this->expectNotToPerformAssertions();

        $observer = new EnrolmentObserver();
        $enrolment = new Enrolment(['progress' => 50]);
        $observer->updating($enrolment);
    }
}
