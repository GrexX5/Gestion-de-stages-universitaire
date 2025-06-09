<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Carbon\Carbon;

class Convention extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'internship_id',
        'student_id',
        'company_supervisor_id',
        'school_supervisor_id',
        'convention_number',
        'start_date',
        'end_date',
        'working_hours_per_week',
        'gross_salary',
        'mission_description',
        'skills_developed',
        'status',
        'validation_date',
        'signature_date',
        'notes',
        'document_path',
    ];

    protected $casts = [
        'start_date' => 'date',
        'end_date' => 'date',
        'validation_date' => 'date',
        'signature_date' => 'date',
        'working_hours_per_week' => 'integer',
        'gross_salary' => 'decimal:2',
    ];

    /**
     * Get the internship that owns the convention.
     */
    public function internship(): BelongsTo
    {
        return $this->belongsTo(Internship::class);
    }

    /**
     * Get the student that owns the convention.
     */
    public function student(): BelongsTo
    {
        return $this->belongsTo(Student::class);
    }

    /**
     * Get the company supervisor for the convention.
     */
    public function companySupervisor(): BelongsTo
    {
        return $this->belongsTo(CompanyContact::class, 'company_supervisor_id');
    }

    /**
     * Get the school supervisor (teacher) for the convention.
     */
    public function schoolSupervisor(): BelongsTo
    {
        return $this->belongsTo(Teacher::class, 'school_supervisor_id');
    }

    /**
     * Scope a query to only include signed conventions.
     */
    public function scopeSigned($query)
    {
        return $query->where('status', 'signed');
    }

    /**
     * Scope a query to only include pending conventions.
     */
    public function scopePending($query)
    {
        return $query->where('status', 'pending');
    }

    /**
     * Check if the convention is signed.
     */
    public function isSigned(): bool
    {
        return $this->status === 'signed';
    }

    /**
     * Get the duration in days.
     */
    public function getDurationInDays(): int
    {
        return Carbon::parse($this->start_date)->diffInDays(Carbon::parse($this->end_date));
    }

    /**
     * Get the duration in months.
     */
    public function getDurationInMonths(): float
    {
        $start = Carbon::parse($this->start_date);
        $end = Carbon::parse($this->end_date);
        return round($start->floatDiffInMonths($end), 1);
    }
}
