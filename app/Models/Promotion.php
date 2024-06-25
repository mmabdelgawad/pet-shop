<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Promotion extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'uuid',
        'title',
        'content',
        'metadata',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'metadata' => 'array',
        ];
    }

    /**
     * Scope a query to only include valid promotions.
     *
     * @param Builder<Promotion> $query
     */
    public function scopeValid(Builder $query): void
    {
        $query->where(function ($query) {
            $query->where('metadata->valid_from', '<=', now());
            $query->where('metadata->valid_to', '>=', now());
        });
    }

    /**
     * Scope a query to only include invalid promotions.
     *
     * @param Builder<Promotion> $query
     */
    public function scopeInvalid(Builder $query): void
    {
        $query->where(function ($query) {
            $query->where('metadata->valid_from', '<', now());
            $query->where('metadata->valid_to', '<', now());
        });
    }
}
