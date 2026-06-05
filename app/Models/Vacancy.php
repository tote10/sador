<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Vacancy extends Model
{
    protected $fillable = [
        'title', 'type', 'location', 'experience', 'education',
        'salary', 'description', 'is_open', 'deadline',
    ];

    protected function casts(): array
    {
        return [
            'is_open' => 'boolean',
            'deadline' => 'date',
        ];
    }

    public function applicants(): HasMany
    {
        return $this->hasMany(Applicant::class);
    }

    public function scopeOpen(Builder $query): Builder
    {
        return $query->where('is_open', true);
    }
}