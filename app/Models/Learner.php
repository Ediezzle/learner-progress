<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Models\Enrolment;

class Learner extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'firstname',
        'lastname',
    ];

    /**
     * Get the enrolments for this learner.
     */
    public function enrolments(): HasMany
    {
        return $this->hasMany(Enrolment::class);
    }

    /**
     * Get the full name of the learner.
     */
    public function getFullNameAttribute(): string
    {
        return trim("{$this->firstname} {$this->lastname}");
    }
}
