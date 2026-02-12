<?php

namespace App\Repositories\Course;

use Illuminate\Database\Eloquent\Collection;

interface CourseRepositoryInterface 
{    
    /**
     * Get all courses, with caching for 24 hours
     *
     * @return Collection
     * 
     * @return Collection<Course>
     */
    public function getAll(): Collection;
}
