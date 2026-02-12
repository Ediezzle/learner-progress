<?php

namespace Tests\Unit;

use App\Models\Enrolment;
use App\Observers\EnrolmentObserver;
use InvalidArgumentException;
use Tests\TestCase;

class EnrolmentObserverTest extends TestCase
{

    public function test_validate_progress_throws_for_invalid_progress()
    {
        $observer = new EnrolmentObserver();
        $enrolment = new Enrolment(['progress' => 150]);
        $this->expectException(InvalidArgumentException::class);
        $observer->updating($enrolment);
    }

    public function test_validate_progress_allows_valid_progress()
    {
        $this->expectNotToPerformAssertions();

        $observer = new EnrolmentObserver();
        $enrolment = new Enrolment(['progress' => 50]);
        $observer->updating($enrolment);
    }
}
