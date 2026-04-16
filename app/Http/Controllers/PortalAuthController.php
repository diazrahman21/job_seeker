<?php

namespace App\Http\Controllers;

use App\Models\Company;
use App\Models\User;
use App\Notifications\JobSeekerOtpNotification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Throwable;

class PortalAuthController extends Controller
{
    public function showJobSeekerLogin()
    {
        return view('auth.job-seeker-login');
    }

    public function jobSeekerLogin(Request $request)
    {
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        if (Auth::guard('job_seeker')->attempt($credentials, $request->boolean('remember'))) {
            $request->session()->regenerate();

            $jobSeeker = Auth::guard('job_seeker')->user()->jobSeeker()->firstOrCreate();
            if (! $jobSeeker->is_verified) {
                return redirect()->route('otp.verification.notice')
                    ->with('success', 'Akun belum terverifikasi. Silakan masukkan OTP yang dikirim ke email Anda.');
            }

            return redirect()->intended(route('job-seeker.dashboard'));
        }

        return back()->withErrors(['email' => 'Email atau password salah.'])->onlyInput('email');
    }

    public function showJobSeekerRegister()
    {
        return view('auth.job-seeker-register');
    }

    public function jobSeekerRegister(Request $request)
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', 'max:255', 'unique:users,email'],
            'password' => ['required', 'confirmed', 'min:8'],
        ]);

        $user = User::create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'password' => Hash::make($validated['password']),
        ]);

        $otp = (string) random_int(100000, 999999);

        $jobSeeker = $user->jobSeeker()->create([
            'is_verified' => false,
            'otp_code' => Hash::make($otp),
            'otp_expired_at' => now()->addMinutes(5),
        ]);

        try {
            $user->notify(new JobSeekerOtpNotification($otp));
        } catch (Throwable $e) {
            Log::error('OTP send failed on register.', [
                'email' => $user->email,
                'message' => $e->getMessage(),
            ]);

            return redirect()->route('otp.verification.notice')
                ->withErrors(['email' => 'OTP gagal dikirim. Periksa konfigurasi SMTP (MAIL_HOST/MAIL_PORT/MAIL_USERNAME/MAIL_PASSWORD).'])
                ->with('success', 'Akun berhasil dibuat, tetapi pengiriman OTP gagal. Silakan perbaiki SMTP lalu klik kirim ulang OTP.');
        }

        Auth::guard('job_seeker')->login($user);
        $request->session()->regenerate();
        $request->session()->put('otp_last_sent_at', now()->timestamp);

        return redirect()->route('otp.verification.notice')
            ->with('success', 'Registrasi berhasil. OTP sudah dikirim ke email Anda.');
    }

    public function showOtpVerification(Request $request)
    {
        $user = Auth::guard('job_seeker')->user();
        if (! $user) {
            return redirect()->route('job-seeker.login');
        }

        $jobSeeker = $user->jobSeeker()->firstOrCreate();
        if ($jobSeeker->is_verified) {
            return redirect()->route('job-seeker.dashboard');
        }

        $lastSentAt = (int) $request->session()->get('otp_last_sent_at', 0);
        $cooldown = max(0, 60 - (now()->timestamp - $lastSentAt));

        return view('auth.otp-verification', [
            'email' => $user->email,
            'resendCooldown' => $cooldown,
        ]);
    }

    public function verifyOtp(Request $request)
    {
        $user = Auth::guard('job_seeker')->user();
        if (! $user) {
            return redirect()->route('job-seeker.login');
        }

        $validated = $request->validate([
            'otp_code' => ['required', 'digits:6'],
        ]);

        $jobSeeker = $user->jobSeeker()->firstOrCreate();

        if (! $jobSeeker->isOtpValid($validated['otp_code'], fn (string $plain, string $hash) => Hash::check($plain, $hash))) {
            return back()->withErrors(['otp_code' => 'OTP tidak valid atau sudah kedaluwarsa.'])->withInput();
        }

        $jobSeeker->update([
            'is_verified' => true,
            'otp_code' => null,
            'otp_expired_at' => null,
        ]);

        return redirect()->route('job-seeker.dashboard')->with('success', 'Verifikasi berhasil. Selamat datang!');
    }

    public function resendOtp(Request $request)
    {
        $user = Auth::guard('job_seeker')->user();
        if (! $user) {
            return redirect()->route('job-seeker.login');
        }

        $lastSentAt = (int) $request->session()->get('otp_last_sent_at', 0);
        $secondsSinceLast = now()->timestamp - $lastSentAt;
        if ($secondsSinceLast < 60) {
            return back()->withErrors([
                'otp_code' => 'Tunggu ' . (60 - $secondsSinceLast) . ' detik sebelum kirim ulang OTP.',
            ]);
        }

        $jobSeeker = $user->jobSeeker()->firstOrCreate();
        if ($jobSeeker->is_verified) {
            return redirect()->route('job-seeker.dashboard');
        }

        $otp = (string) random_int(100000, 999999);
        $jobSeeker->update([
            'otp_code' => Hash::make($otp),
            'otp_expired_at' => now()->addMinutes(5),
        ]);

        try {
            $user->notify(new JobSeekerOtpNotification($otp));
        } catch (Throwable $e) {
            Log::error('OTP resend failed.', [
                'email' => $user->email,
                'message' => $e->getMessage(),
            ]);

            return back()->withErrors([
                'otp_code' => 'Kirim ulang OTP gagal. Periksa konfigurasi SMTP Anda.',
            ]);
        }
        $request->session()->put('otp_last_sent_at', now()->timestamp);

        return back()->with('success', 'OTP baru berhasil dikirim. Berlaku selama 5 menit.');
    }

    public function showRecruiterLogin()
    {
        return view('auth.recruiter-login');
    }

    public function recruiterLogin(Request $request)
    {
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        if (Auth::guard('recruiter')->attempt($credentials, $request->boolean('remember'))) {
            $request->session()->regenerate();
            return redirect()->route('recruiter.dashboard');
        }

        return back()->withErrors(['email' => 'Email atau password salah.'])->onlyInput('email');
    }

    public function showRecruiterRegister()
    {
        return view('auth.recruiter-register');
    }

    public function recruiterRegister(Request $request)
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', 'max:255', 'unique:companies,email'],
            'password' => ['required', 'confirmed', 'min:8'],
            'website' => ['nullable', 'url'],
            'location' => ['nullable', 'string', 'max:255'],
            'description' => ['nullable', 'string'],
        ]);

        $company = Company::create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'password' => Hash::make($validated['password']),
            'website' => $validated['website'] ?? null,
            'location' => $validated['location'] ?? null,
            'description' => $validated['description'] ?? null,
            'status' => 'pending',
        ]);

        Auth::guard('recruiter')->login($company);
        $request->session()->regenerate();

        return redirect()->route('recruiter.dashboard');
    }

    public function showAdminLogin()
    {
        return view('auth.admin-login');
    }

    public function adminLogin(Request $request)
    {
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        if (Auth::guard('admin')->attempt($credentials, $request->boolean('remember'))) {
            $request->session()->regenerate();
            return redirect()->route('admin.dashboard');
        }

        return back()->withErrors(['email' => 'Email atau password admin salah.'])->onlyInput('email');
    }

    public function logout(Request $request)
    {
        if (Auth::guard('admin')->check()) {
            Auth::guard('admin')->logout();
        } elseif (Auth::guard('recruiter')->check()) {
            Auth::guard('recruiter')->logout();
        } else {
            Auth::guard('job_seeker')->logout();
        }

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('home');
    }
}
