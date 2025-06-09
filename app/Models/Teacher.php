<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Teacher extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'user_id',
        'teacher_number',
        'first_name',
        'last_name',
        'email',
        'phone',
        'office',
        'department',
        'specialization',
        'profile_picture',
        'is_active',
    ];

    protected $casts = [
        'is_active' => 'boolean',
    ];

    /**
     * Get the user associated with the teacher.
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Get the internships supervised by this teacher.
     */
    public function supervisedInternships(): HasMany
    {
        return $this->hasMany(Internship::class, 'supervisor_id');
    }

    /**
     * Get the conventions supervised by this teacher.
     */
    public function supervisedConventions(): HasMany
    {
        return $this->hasMany(Convention::class, 'school_supervisor_id');
    }

    /**
     * Get the applications reviewed by this teacher.
     */
    public function reviewedApplications(): HasMany
    {
        return $this->hasMany(Application::class, 'reviewed_by');
    }

    /**
     * Get the full name of the teacher.
     */
    public function getFullNameAttribute(): string
    {
        return "{$this->first_name} {$this->last_name}";
    }
}
