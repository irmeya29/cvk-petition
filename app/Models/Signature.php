<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Signature extends Model
{
    protected $fillable = [
        'petition_id',
        'first_name',
        'last_name',
        'email',
        'display_name',
        'accepted_terms',
        'accepted_data_policy',
        'signed_at',
        'ip_address',
        'user_agent',
    ];

    protected $casts = [
        'display_name' => 'boolean',
        'accepted_terms' => 'boolean',
        'accepted_data_policy' => 'boolean',
        'signed_at' => 'datetime',
    ];

    protected $hidden = [
        'email',
        'ip_address',
        'user_agent',
    ];

    public function petition(): BelongsTo
    {
        return $this->belongsTo(Petition::class);
    }

    public function getPublicNameAttribute(): string
    {
        return "{$this->first_name} {$this->last_name}";
    }
}
