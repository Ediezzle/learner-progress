<?php

namespace App\Repositories\Course;

use App\Models\Course;
use Illuminate\Support\Facades\Cache;
use Illuminate\Database\Eloquent\Collection;

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
