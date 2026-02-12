<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\ListLearnerProgressRequest;
use App\Models\Learner;
use App\Repositories\Course\CourseRepositoryInterface;
use App\Repositories\LearnerProgress\LearnerProgressRepositoryInterface;
use Illuminate\Contracts\View\View;

class LearnerProgressController extends Controller
{
    /**
     * Display a listing of learners with their progress
     * 
     * @param ListLearnerProgressRequest $request
     * 
     * @return View
     */
    public function index(
        ListLearnerProgressRequest $request,
        CourseRepositoryInterface $courseRepo,
        LearnerProgressRepositoryInterface $learnerProgressRepo
    ): View {
        $perPage = $request->get('per_page', 10);
        $courseFilter = $request->get('course_id');
        $sortDirection = $request->get('sort_direction', 'asc');

        $learners = $learnerProgressRepo->getAllWithEnrolmentProgress($perPage, $courseFilter, $sortDirection);
        $courses = $courseRepo->getAll();

        return view(
            'learner-progress.index',
            compact('learners', 'courses', 'courseFilter', 'sortDirection', 'perPage')
        );
    }

    /**
     * Display detailed progress for a specific learner
     * 
     * @param Learner $learner
     * 
     * @return View
     */
    public function show(Learner $learner): View
    {
        $learner->load('enrolments.course:id,name');

        return view('learner-progress.show', compact('learner'));
    }
}
