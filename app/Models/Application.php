<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Carbon\Carbon;

class Application extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'offer_id',
        'student_id',
        'motivation_letter',
        'cv_path',
        'transcript_path',
        'other_documents',
        'status',
        'feedback',
        'submitted_at',
        'reviewed_at',
        'reviewed_by',
        'review_notes',
    ];

    protected $casts = [
        'submitted_at' => 'datetime',
        'reviewed_at' => 'datetime',
    ];

    /**
     * The "booted" method of the model.
     */
    protected static function booted()
    {
        static::creating(function ($application) {
            $application->submitted_at = now();
        });
    }

    /**
     * Get the internship that the application is for.
     */
    public function offer(): BelongsTo
    {
        return $this->belongsTo(Offer::class);
    }

    /**
     * Get the student that made the application.
     */
    public function student(): BelongsTo
    {
        return $this->belongsTo(Student::class);
    }

    /**
     * Get the user who reviewed the application.
     */
    public function reviewer(): BelongsTo
    {
        return $this->belongsTo(User::class, 'reviewed_by');
    }

    /**
     * Scope a query to only include applications with a specific status.
     */
    public function scopeStatus($query, $status)
    {
        return $query->where('status', $status);
    }

    /**
     * Mark the application as under review.
     */
    public function markAsUnderReview(User $reviewer): void
    {
        $this->update([
            'status' => 'under_review',
            'reviewed_by' => $reviewer->id,
            'reviewed_at' => now(),
        ]);
    }

    /**
     * Mark the application as accepted.
     */
    public function markAsAccepted(User $reviewer, ?string $notes = null): void
    {
        $this->update([
            'status' => 'accepted',
            'reviewed_by' => $reviewer->id,
            'reviewed_at' => now(),
            'review_notes' => $notes,
        ]);
    }

    /**
     * Mark the application as rejected.
     */
    public function markAsRejected(User $reviewer, ?string $feedback = null): void
    {
        $this->update([
            'status' => 'rejected',
            'reviewed_by' => $reviewer->id,
            'reviewed_at' => now(),
            'feedback' => $feedback,
        ]);
    }

    /**
     * Check if the application is pending review.
     */
    public function isPending(): bool
    {
        return $this->status === 'submitted';
    }

    /**
     * Check if the application is under review.
     */
    public function isUnderReview(): bool
    {
        return $this->status === 'under_review';
    }

    /**
     * Check if the application is accepted.
     */
    public function isAccepted(): bool
    {
        return $this->status === 'accepted';
    }

    /**
     * Check if the application is rejected.
     */
    public function isRejected(): bool
    {
        return $this->status === 'rejected';
    }
}
