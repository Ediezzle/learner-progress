<?php

namespace App\Http\Controllers;

use App\Models\Learner;

class LearnerProgressController extends Controller
{
    /**
     * Display a listing of learners with their progress.
     */
    public function index()
    {
        $perPage = request('per_page', 5);

        $learners = Learner::with('enrolments.course:id,name')->select(['id'])->paginate($perPage);

        return view('learner-progress.index', compact('learners'));
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
