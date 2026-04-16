<?php

namespace App\Http\Controllers;

use App\Mail\ApplicationStatusChangedMail;
use App\Models\Application;
use App\Models\Job;
use App\Notifications\ApplicationStatusChangedNotification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class RecruiterController extends Controller
{
    public function dashboard(Request $request)
    {
        $company = auth('recruiter')->user();

        return view('recruiter.dashboard', [
            'totalPostings' => $company->jobs()->count(),
            'totalApplicants' => Application::whereHas('job', fn ($q) => $q->where('company_id', $company->id))->count(),
            'activeJobs' => $company->jobs()->where('status', 'approved')->where('deadline_at', '>=', now())->count(),
        ]);
    }

    public function profile(Request $request)
    {
        $company = auth('recruiter')->user();

        return view('recruiter.profile', [
            'company' => $company,
        ]);
    }

    public function updateProfile(Request $request)
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'location' => ['required', 'string', 'max:255'],
            'industry' => ['required', 'string', 'max:255'],
            'company_size' => ['required', 'in:1-50,51-200,201-500,501-1000,1000+'],
            'founded_year' => ['required', 'integer', 'min:1900', 'max:' . date('Y')],
            'description' => ['required', 'string', 'min:20'],
            'website' => ['nullable', 'url'],
            'phone' => ['nullable', 'string', 'max:20'],
            'logo' => ['nullable', 'image', 'max:2048'],
        ]);

        $company = auth('recruiter')->user();

        if ($request->hasFile('logo')) {
            $validated['logo_path'] = $request->file('logo')->store('logos', 'public');
        }

        $company->update($validated);

        return back()->with('success', 'Profil perusahaan berhasil diperbarui.');
    }

    public function updateProfileSocial(Request $request)
    {
        $validated = $request->validate([
            'linkedin' => ['nullable', 'url'],
            'twitter' => ['nullable', 'url'],
            'instagram' => ['nullable', 'url'],
        ]);

        $company = auth('recruiter')->user();
        $socialMedia = [
            'linkedin' => $validated['linkedin'] ?? null,
            'twitter' => $validated['twitter'] ?? null,
            'instagram' => $validated['instagram'] ?? null,
        ];

        $company->update([
            'social_media' => json_encode($socialMedia),
        ]);

        return back()->with('success', 'Media sosial berhasil diperbarui.');
    }

    public function jobs(Request $request)
    {
        return view('recruiter.jobs-index', [
            'jobs' => auth('recruiter')->user()->jobs()->latest()->cursorPaginate(10),
        ]);
    }

    public function createJob()
    {
        return view('recruiter.job-form', ['job' => new Job()]);
    }

    public function storeJob(Request $request)
    {
        $validated = $this->validateJob($request);
        $validated['company_id'] = auth('recruiter')->id();
        $validated['status'] = 'pending';

        Job::create($validated);

        return redirect()->route('recruiter.jobs')->with('success', 'Lowongan dibuat dan menunggu approval admin.');
    }

    public function editJob(Job $job)
    {
        $this->ensureOwner($job);
        return view('recruiter.job-form', ['job' => $job]);
    }

    public function updateJob(Request $request, Job $job)
    {
        $this->ensureOwner($job);
        $validated = $this->validateJob($request);
        $validated['status'] = 'pending';
        $job->update($validated);

        return redirect()->route('recruiter.jobs')->with('success', 'Lowongan diperbarui.');
    }

    public function destroyJob(Job $job)
    {
        $this->ensureOwner($job);
        $job->delete();

        return back()->with('success', 'Lowongan dihapus.');
    }

    public function applicants(Job $job)
    {
        $this->ensureOwner($job);

        return view('recruiter.applicants', [
            'job' => $job,
            'applications' => $job->applications()->with('user')->latest()->cursorPaginate(10),
        ]);
    }

    public function updateApplicationStatus(Request $request, Application $application)
    {
        $this->ensureOwner($application->job);

        $validated = $request->validate([
            'status' => ['required', 'in:applied,review,interview,rejected,hired'],
            'status_note' => ['nullable', 'string'],
        ]);

        $application->update($validated);

        $application->user->notify(new ApplicationStatusChangedNotification($application));
        Mail::to($application->user->email)->send(new ApplicationStatusChangedMail($application));

        return back()->with('success', 'Status lamaran diperbarui dan notifikasi terkirim.');
    }

    public function downloadCv(Application $application)
    {
        $this->ensureOwner($application->job);

        $media = $application->user->media()->where('id', $application->cv_media_id)->firstOrFail();

        return response()->download($media->getPath(), $media->file_name);
    }

    private function ensureOwner(Job $job): void
    {
        abort_unless($job->company_id === auth('recruiter')->id(), 403);
    }

    private function validateJob(Request $request): array
    {
        return $request->validate([
            'title' => ['required', 'string', 'max:255'],
            'description' => ['required', 'string'],
            'requirements' => ['required', 'string'],
            'location' => ['required', 'string', 'max:255'],
            'category' => ['required', 'string', 'max:255'],
            'employment_type' => ['required', 'in:full-time,part-time,contract,internship'],
            'salary_min' => ['nullable', 'numeric'],
            'salary_max' => ['nullable', 'numeric'],
            'deadline_at' => ['required', 'date', 'after:today'],
        ]);
    }
}
