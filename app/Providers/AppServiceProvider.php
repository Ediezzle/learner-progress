<?php

namespace App\Providers;

use App\Models\Course;
use App\Models\Enrolment;
use App\Observers\CourseObserver;
use App\Observers\EnrolmentObserver;
use Illuminate\Support\ServiceProvider;
use App\Repositories\Course\CourseRepository;
use App\Repositories\Course\CourseRepositoryInterface;
use App\Repositories\LearnerProgress\LearnerProgressRepository;
use App\Repositories\LearnerProgress\LearnerProgressRepositoryInterface;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Enrolment::observe(EnrolmentObserver::class);
        Course::observe(CourseObserver::class);

        $this->app->singleton(
            CourseRepositoryInterface::class,
            CourseRepository::class
        );

        $this->app->singleton(
            LearnerProgressRepositoryInterface::class,
            LearnerProgressRepository::class
        );
    }
}
