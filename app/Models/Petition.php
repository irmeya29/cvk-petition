<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Petition extends Model
{
    protected $fillable = [
        'uuid',
        'slug',
        'organization_name',
        'title',
        'subtitle',
        'description',
        'target_text',
        'goal_signatures',
        'is_active',
        'starts_at',
        'ends_at',
    ];

    protected $casts = [
        'is_active' => 'boolean',
        'starts_at' => 'datetime',
        'ends_at' => 'datetime',
    ];

    public function signatures(): HasMany
    {
        return $this->hasMany(Signature::class);
    }

    public function publicSignatures(): HasMany
    {
        return $this->hasMany(Signature::class)
            ->where('display_name', true)
            ->latest('signed_at');
    }

    public function getProgressPercentageAttribute(): int
    {
        if ($this->goal_signatures <= 0) {
            return 0;
        }

        $count = $this->signatures_count ?? $this->signatures()->count();

        return min(100, (int) round(($count / $this->goal_signatures) * 100));
    }
}
