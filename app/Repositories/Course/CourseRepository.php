<?php

namespace App\Repositories\Course;

use App\Models\Course;
use App\Repositories\Course\CourseRepositoryInterface;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\Cache;

class CourseRepository implements CourseRepositoryInterface
{
    public function getAll(): Collection
    {
        return Cache::remember(
            config('cache.course_cache_key'),
            now()->addDay(),
            function () {
                return Course::orderBy('name')->get();
            }
        );
    }
}
