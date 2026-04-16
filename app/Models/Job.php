<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Job extends Model
{
    use HasFactory;

    protected $table = 'job_listings';

    protected $fillable = [
        'company_id',
        'title',
        'description',
        'requirements',
        'location',
        'category',
        'employment_type',
        'salary_min',
        'salary_max',
        'deadline_at',
        'status',
    ];

    protected function casts(): array
    {
        return [
            'deadline_at' => 'datetime',
            'salary_min' => 'decimal:2',
            'salary_max' => 'decimal:2',
        ];
    }

    public function company(): BelongsTo
    {
        return $this->belongsTo(Company::class);
    }

    public function applications(): HasMany
    {
        return $this->hasMany(Application::class);
    }

    public function bookmarkedBy(): BelongsToMany
    {
        return $this->belongsToMany(User::class, 'bookmarks')->withTimestamps();
    }

    public function scopePublicOpen(Builder $query): Builder
    {
        return $query->where('status', 'approved')->where('deadline_at', '>=', now());
    }

    public function scopeFilter(Builder $query, array $filters): Builder
    {
        return $query
            ->when($filters['q'] ?? null, function (Builder $q, string $value) {
                $q->where(function (Builder $inner) use ($value) {
                    $inner->where('title', 'like', "%{$value}%")
                        ->orWhere('description', 'like', "%{$value}%")
                        ->orWhere('requirements', 'like', "%{$value}%");
                });
            })
            ->when($filters['location'] ?? null, fn (Builder $q, string $value) => $q->where('location', $value))
            ->when($filters['category'] ?? null, fn (Builder $q, string $value) => $q->where('category', $value))
            ->when($filters['employment_type'] ?? null, fn (Builder $q, string $value) => $q->where('employment_type', $value))
            ->when($filters['salary_min'] ?? null, fn (Builder $q, string $value) => $q->where('salary_max', '>=', (float) $value))
            ->when($filters['salary_max'] ?? null, fn (Builder $q, string $value) => $q->where('salary_min', '<=', (float) $value));
    }
}
