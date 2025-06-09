<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class CompanyContact extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'company_id',
        'first_name',
        'last_name',
        'position',
        'email',
        'phone',
        'mobile',
        'is_main_contact',
        'is_active',
        'notes',
    ];

    protected $casts = [
        'is_main_contact' => 'boolean',
        'is_active' => 'boolean',
    ];

    /**
     * Get the company that owns the contact.
     */
    public function company(): BelongsTo
    {
        return $this->belongsTo(Company::class);
    }

    /**
     * Get the conventions where this contact is a supervisor.
     */
    public function supervisedConventions(): HasMany
    {
        return $this->hasMany(Convention::class, 'company_supervisor_id');
    }

    /**
     * Get the full name of the contact.
     */
    public function getFullNameAttribute(): string
    {
        return "{$this->first_name} {$this->last_name}";
    }
}
