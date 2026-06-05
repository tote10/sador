<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Setting extends Model
{
    protected $fillable = ['key', 'value', 'group'];

    public static function get(string $key, mixed $default = null): mixed
    {
        return static::query()->where('key', $key)->value('value') ?? $default;
    }

    public static function set(string $key, mixed $value, ?string $group = null): void
    {
        static::updateOrCreate(
            ['key' => $key],
            ['value' => $value, 'group' => $group]
        );
    }

    public static function getJson(string $key, array $default = []): array
    {
        $decoded = json_decode(static::get($key, ''), true);

        return is_array($decoded) ? $decoded : $default;
    }

    public static function setJson(string $key, array $value, ?string $group = null): void
    {
        static::set($key, json_encode($value), $group);
    }
}