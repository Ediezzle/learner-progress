<?php

namespace App\Repositories\LearnerProgress;

use App\Models\Enrolment;
use App\Models\Learner;
use App\Repositories\LearnerProgress\LearnerProgressRepositoryInterface;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;

class LearnerProgressRepository implements LearnerProgressRepositoryInterface
{
    public function getAllWithEnrolmentProgress(
        ?int $perPage,
        ?int $courseId = null,
        ?string $sortDirection = 'asc'
    ): Collection|LengthAwarePaginator {
        $query = Learner::with('enrolments.course:id,name')
            ->when($courseId, function ($q, $courseId) {
                $q->whereHas('enrolments', function (Builder $q) use ($courseId) {
                    $q->where('course_id', $courseId);
                });
            })
            ->withAvg((new Enrolment)->getTable(), 'progress')
            ->orderBy('enrolments_avg_progress', $sortDirection);

        return $perPage ? $query->paginate($perPage) : $query->get();
    }
}
