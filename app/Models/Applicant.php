<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Applicant extends Model
{
    public const STATUS_NEW = 'new';
    public const STATUS_REVIEWED = 'reviewed';
    public const STATUS_INTERVIEWED = 'interviewed';
    public const STATUS_HIRED = 'hired';

    protected $fillable = [
        'vacancy_id', 'full_name', 'phone', 'email',
        'message', 'cv_path', 'status',
    ];

    public function vacancy(): BelongsTo
    {
        return $this->belongsTo(Vacancy::class);
    }

    public function scopeStatus(Builder $query, string $status): Builder
    {
        return $query->where('status', $status);
    }

    public function getCvUrlAttribute(): string
    {
        return asset('storage/' . $this->cv_path);
    }
}