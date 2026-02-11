<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\Learner;
use Illuminate\Database\Eloquent\Builder;
use App\Http\Requests\ListLearnerProgressRequest;

class LearnerProgressController extends Controller
{
    /**
     * Display a listing of learners with their progress.
     */
    public function index(ListLearnerProgressRequest $request)
    {
        $perPage = $request->get('per_page', 10);
        $courseFilter = $request->get('course_id');
        $sortDirection = $request->get('sort_direction', 'asc');

        $query = Learner::with('enrolments.course:id,name')
            ->when($courseFilter, function ($q, $courseFilter) {
                $q->whereHas('enrolments', function (Builder $q) use ($courseFilter) {
                    $q->where('course_id', $courseFilter);
                });
            });

        // Sort by progress with direction (high to low or low to high)
        $query->withAvg('enrolments', 'progress')
            ->orderBy('enrolments_avg_progress', $sortDirection);

        $learners = $query->paginate($perPage);
        $courses = Course::orderBy('name')->get(['id', 'name']);

        return view(
            'learner-progress.index',
            compact('learners', 'courses', 'courseFilter', 'sortDirection', 'perPage')
        );
    }

    /**
     * Display detailed progress for a specific learner.
     */
    public function show(Learner $learner)
    {
        $learner->load('enrolments.course:id,name');

        return view('learner-progress.show', compact('learner'));
    }
}
