<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class JobSeeker extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'provider',
        'provider_id',
        'avatar',
        'is_verified',
        'otp_code',
        'otp_expired_at',
    ];

    protected function casts(): array
    {
        return [
            'is_verified' => 'boolean',
            'otp_expired_at' => 'datetime',
        ];
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function profile(): HasOne
    {
        return $this->hasOne(Profile::class);
    }

    public function skills(): HasMany
    {
        return $this->hasMany(Skill::class);
    }

    public function experiences(): HasMany
    {
        return $this->hasMany(Experience::class);
    }

    public function educations(): HasMany
    {
        return $this->hasMany(Education::class);
    }

    public function cvs(): HasMany
    {
        return $this->hasMany(Cv::class);
    }

    public function isOtpValid(string $otp, callable $hashCheck): bool
    {
        if (! $this->otp_code || ! $this->otp_expired_at) {
            return false;
        }

        return $this->otp_expired_at->isFuture() && $hashCheck($otp, $this->otp_code);
    }

    public function completionPercentage(): int
    {
        $profile = $this->profile;
        $checks = [
            ! empty($this->user?->name),
            ! empty($profile?->title),
            ! empty($profile?->location),
            ! empty($profile?->bio),
            $this->skills()->exists(),
            $this->cvs()->exists(),
        ];

        $completed = collect($checks)->filter()->count();

        return (int) round(($completed / count($checks)) * 100);
    }
}
