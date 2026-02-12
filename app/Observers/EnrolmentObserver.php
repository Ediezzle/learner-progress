<?php

namespace App\Observers;

use App\Models\Enrolment;
use InvalidArgumentException;

class EnrolmentObserver
{
    /**
     * Handle the Enrolment "creating" event.
     */
    public function creating(Enrolment $enrolment): void
    {
        $this->validateProgress($enrolment);
    }

    /**
     * Handle the Enrolment "updating" event.
     */
    public function updating(Enrolment $enrolment): void
    {
        $this->validateProgress($enrolment);
    }

    private function validateProgress(Enrolment $enrolment): void
    {
        throw_if(
            $enrolment->progress < 0 || $enrolment->progress > 100,
            new InvalidArgumentException('Progress must be between 0 and 100.')
        );
    }
}
