<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Carbon\Carbon;

class Internship extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'company_id',
        'supervisor_id',
        'title',
        'description',
        'required_skills',
        'benefits',
        'type',
        'duration',
        'work_schedule',
        'salary',
        'location',
        'remote_allowed',
        'available_positions',
        'start_date',
        'end_date',
        'application_deadline',
        'status',
        'is_active',
        'notes',
    ];

    protected $casts = [
        'remote_allowed' => 'boolean',
        'is_active' => 'boolean',
        'available_positions' => 'integer',
        'start_date' => 'date',
        'end_date' => 'date',
        'application_deadline' => 'date',
        'salary' => 'decimal:2',
    ];

    /**
     * Get the company that owns the internship.
     */
    public function company(): BelongsTo
    {
        return $this->belongsTo(Company::class);
    }

    /**
     * Get the supervisor (teacher) for the internship.
     */
    public function supervisor(): BelongsTo
    {
        return $this->belongsTo(Teacher::class, 'supervisor_id');
    }

    /**
     * Get the applications for the internship.
     */
    public function applications(): HasMany
    {
        return $this->hasMany(Application::class);
    }

    /**
     * Get the conventions for the internship.
     */
    public function conventions(): HasMany
    {
        return $this->hasMany(Convention::class);
    }

    /**
     * Scope a query to only include active internships.
     */
    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    /**
     * Scope a query to only include published internships.
     */
    public function scopePublished($query)
    {
        return $query->where('status', 'published');
    }

    /**
     * Check if the internship is accepting applications.
     */
    public function isAcceptingApplications(): bool
    {
        return $this->status === 'published' && 
               $this->application_deadline->isFuture() &&
               $this->available_positions > $this->applications()->whereIn('status', ['submitted', 'under_review', 'interview_scheduled', 'accepted'])->count();
    }

    /**
     * Get the duration in months.
     */
    public function getDurationInMonths(): int
    {
        $start = Carbon::parse($this->start_date);
        $end = Carbon::parse($this->end_date);
        return $start->diffInMonths($end);
    }
}
