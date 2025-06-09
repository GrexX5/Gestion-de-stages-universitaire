<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Company extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'user_id',
        'name',
        'siret',
        'naf_code',
        'legal_status',
        'contact_first_name',
        'contact_last_name',
        'contact_position',
        'email',
        'phone',
        'website',
        'description',
        'address',
        'city',
        'postal_code',
        'country',
        'logo_path',
        'is_active',
        'is_partner',
        'partnership_start_date',
        'notes',
    ];

    protected $casts = [
        'is_active' => 'boolean',
        'is_partner' => 'boolean',
        'partnership_start_date' => 'date',
    ];

    /**
     * Get the contacts for the company.
     */
    public function contacts(): HasMany
    {
        return $this->hasMany(CompanyContact::class);
    }

    /**
     * Get the main contact for the company.
     */
    public function mainContact()
    {
        return $this->hasOne(CompanyContact::class)->where('is_main_contact', true);
    }

    /**
     * Get the internships for the company.
     */
    public function internships(): HasMany
    {
        return $this->hasMany(Internship::class);
    }

    /**
     * Get the full address of the company.
     */
    public function getFullAddressAttribute(): string
    {
        return "{$this->address}, {$this->postal_code} {$this->city}, {$this->country}";
    }

    /**
     * Get the contact person's full name.
     */
    public function getContactFullNameAttribute(): string
    {
        return "{$this->contact_first_name} {$this->contact_last_name}";
    }

    /**
     * Get the user that owns the company.
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
