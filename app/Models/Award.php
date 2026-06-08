<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

class Award extends Model
{
    protected $fillable = [
        'title', 'year', 'organization', 'description', 'logo_path', 'is_published',
    ];

    protected function casts(): array
    {
        return ['is_published' => 'boolean'];
    }

    public function scopePublished(Builder $query): Builder
    {
        return $query->where('is_published', true);
    }

    public function getLogoUrlAttribute(): ?string
    {
        if (!$this->logo_path) {
            return null;
        }

        if (str_starts_with($this->logo_path, 'http://') || str_starts_with($this->logo_path, 'https://')) {
            return $this->logo_path;
        }

        return asset('storage/' . $this->logo_path);
    }
}