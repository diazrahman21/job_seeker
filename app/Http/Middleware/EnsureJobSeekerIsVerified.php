<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class EnsureJobSeekerIsVerified
{
    public function handle(Request $request, Closure $next): Response
    {
        $user = auth('job_seeker')->user();

        if (! $user) {
            return redirect()->route('job-seeker.login');
        }

        $jobSeeker = $user->jobSeeker;

        if (! $jobSeeker || ! $jobSeeker->is_verified) {
            return redirect()->route('otp.verification.notice')
                ->withErrors(['otp' => 'Akun Anda belum terverifikasi. Masukkan OTP untuk melanjutkan.']);
        }

        return $next($request);
    }
}
