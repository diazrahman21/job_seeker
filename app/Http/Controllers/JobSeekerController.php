<?php

namespace App\Http\Controllers;

use App\Models\Application;
use App\Models\Education;
use App\Models\Experience;
use App\Models\Job;
use Illuminate\Http\Request;

class JobSeekerController extends Controller
{
    public function dashboard(Request $request)
    {
        $applications = $request->user()
            ->applications()
            ->with('job.company')
            ->latest()
            ->cursorPaginate(10);

        return view('job-seeker.dashboard', [
            'applications' => $applications,
            'statusCounts' => $request->user()->applications()
                ->selectRaw('status, count(*) as total')
                ->groupBy('status')
                ->pluck('total', 'status'),
        ]);
    }

    public function profile(Request $request)
    {
        return view('job-seeker.profile', [
            'user' => $request->user(),
            'experiences' => $request->user()->experiences()->latest()->get(),
            'educations' => $request->user()->educations()->latest()->get(),
            'cvs' => $request->user()->getMedia('cvs'),
        ]);
    }

    public function updateProfile(Request $request)
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'title' => ['nullable', 'string', 'max:255'],
            'location' => ['nullable', 'string', 'max:255'],
            'bio' => ['nullable', 'string'],
            'skills' => ['nullable', 'string'],
            'photo' => ['nullable', 'image', 'max:2048'],
        ]);

        $validated['skills'] = !empty($validated['skills'])
            ? array_map('trim', explode(',', $validated['skills']))
            : [];

        if ($request->hasFile('photo')) {
            $validated['profile_photo_path'] = $request->file('photo')->store('profile-photos', 'public');
        }

        $request->user()->update($validated);

        return back()->with('success', 'Profil berhasil diperbarui.');
    }

    public function addExperience(Request $request)
    {
        $validated = $request->validate([
            'company_name' => ['required', 'string', 'max:255'],
            'job_title' => ['required', 'string', 'max:255'],
            'start_date' => ['required', 'date'],
            'end_date' => ['nullable', 'date'],
            'description' => ['nullable', 'string'],
        ]);

        $request->user()->experiences()->create($validated);

        return back()->with('success', 'Pengalaman kerja ditambahkan.');
    }

    public function addEducation(Request $request)
    {
        $validated = $request->validate([
            'school_name' => ['required', 'string', 'max:255'],
            'degree' => ['required', 'string', 'max:255'],
            'field_of_study' => ['nullable', 'string', 'max:255'],
            'start_year' => ['nullable', 'integer', 'min:1950', 'max:2100'],
            'end_year' => ['nullable', 'integer', 'min:1950', 'max:2100'],
            'description' => ['nullable', 'string'],
        ]);

        $request->user()->educations()->create($validated);

        return back()->with('success', 'Riwayat pendidikan ditambahkan.');
    }

    public function uploadCv(Request $request)
    {
        $request->validate([
            'cv_file' => ['required', 'mimes:pdf', 'max:5120'],
        ]);

        $request->user()->addMediaFromRequest('cv_file')->toMediaCollection('cvs');

        return back()->with('success', 'CV berhasil diunggah.');
    }

    public function removeCv(Request $request, int $mediaId)
    {
        $media = $request->user()->getMedia('cvs')->firstWhere('id', $mediaId);
        abort_unless($media, 404);
        $media->delete();

        return back()->with('success', 'CV dihapus.');
    }

    public function jobs()
    {
        return view('job-seeker.jobs');
    }

    public function detail(Job $job)
    {
        abort_if($job->status !== 'approved', 404);

        $user = auth('job_seeker')->user();

        return view('job-seeker.job-detail', [
            'job' => $job->load('company'),
            'cvs' => $user->getMedia('cvs'),
            'hasApplied' => $user->applications()->where('job_id', $job->id)->exists(),
            'isBookmarked' => $user->bookmarks()->where('job_id', $job->id)->exists(),
        ]);
    }

    public function apply(Request $request, Job $job)
    {
        abort_if($job->status !== 'approved', 400);

        $validated = $request->validate([
            'cover_letter' => ['nullable', 'string'],
            'cv_media_id' => ['nullable', 'integer', 'required_without:cv_file'],
            'cv_file' => ['nullable', 'file', 'mimes:pdf', 'max:5120', 'required_without:cv_media_id'],
        ]);

        if ($request->hasFile('cv_file')) {
            $cv = $request->user()->addMediaFromRequest('cv_file')->toMediaCollection('cvs');
        } else {
            $cv = $request->user()->getMedia('cvs')->firstWhere('id', (int) ($validated['cv_media_id'] ?? 0));

            if (! $cv) {
                return back()->withErrors([
                    'cv_media_id' => 'Silakan pilih CV yang valid atau upload CV PDF baru.',
                ])->withInput();
            }
        }

        Application::create([
            'job_id' => $job->id,
            'user_id' => $request->user()->id,
            'cv_media_id' => $cv->id,
            'cover_letter' => $validated['cover_letter'] ?? null,
            'status' => 'applied',
        ]);

        return redirect()->route('job-seeker.dashboard')->with('success', 'Lamaran berhasil dikirim.');
    }

    public function toggleBookmark(Job $job)
    {
        $user = auth('job_seeker')->user();

        if ($user->bookmarks()->where('job_id', $job->id)->exists()) {
            $user->bookmarks()->detach($job->id);
        } else {
            $user->bookmarks()->attach($job->id);
        }

        return back()->with('success', 'Bookmark diperbarui.');
    }

    public function bookmarks(Request $request)
    {
        return view('job-seeker.bookmarks', [
            'jobs' => $request->user()->bookmarks()->with('company')->latest('job_listings.id')->cursorPaginate(10),
        ]);
    }
}
