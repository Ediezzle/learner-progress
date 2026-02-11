<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Enrolment extends Model
{
    /**
     * Indicates if the IDs are auto-incrementing.
     *
     * @var bool
     */
    public $incrementing = false;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'enrolments';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'learner_id',
        'course_id',
        'progress',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'progress' => 'decimal:2',
    ];

    /**
     * Get the learner for this enrolment.
     */
    public function learner(): BelongsTo
    {
        return $this->belongsTo(Learner::class);
    }

    /**
     * Get the course for this enrolment.
     */
    public function course(): BelongsTo
    {
        return $this->belongsTo(Course::class);
    }
}
