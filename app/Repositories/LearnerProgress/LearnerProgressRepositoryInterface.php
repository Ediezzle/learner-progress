<?php

namespace App\Repositories\LearnerProgress;

use App\Models\Learner;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

interface LearnerProgressRepositoryInterface
{
    /**
     * get all learners with their enrolment progress
     *
     * @param  int|null $perPage
     * @param  int|null $courseId
     * @param  string|null $sortDirection
     * 
     * @return Collection<Learner>|LengthAwarePaginator
     */
    public function getAllWithEnrolmentProgress(
        ?int $perPage,
        ?int $courseId = null,
        ?string $sortDirection = 'asc'
    ): Collection|LengthAwarePaginator;
}
