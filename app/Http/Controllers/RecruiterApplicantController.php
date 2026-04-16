<?php

namespace App\Http\Controllers;

use App\Models\Application;
use App\Notifications\ApplicationStatusChangedNotification;
use App\Mail\ApplicationStatusChangedMail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Storage;

class RecruiterApplicantController extends Controller
{
    /**
     * Display a listing of applicants
     */
    public function index(Request $request)
    {
        $company = auth('recruiter')->user();

        $query = Application::whereHas('job', fn ($q) => $q->where('company_id', $company->id));

        // Search by name or email
        if ($request->filled('search')) {
            $search = $request->input('search');
            $query->whereHas('user', function ($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                    ->orWhere('email', 'like', "%{$search}%");
            });
        }

        // Filter by status
        if ($request->filled('status')) {
            $query->where('status', $request->input('status'));
        }

        // Filter by job
        if ($request->filled('job_id')) {
            $query->where('job_id', $request->input('job_id'));
        }

        $applicants = $query
            ->with(['job', 'user'])
            ->latest()
            ->paginate(15);

        return view('recruiter.applicants.index', compact('applicants'));
    }

    /**
     * Display applicant detail
     */
    public function show(Application $applicant)
    {
        $this->authorize('view', $applicant);

        $applicant->load([
            'job',
            'user'
        ]);

        return view('recruiter.applicants.show', compact('applicant'));
    }

    /**
     * Update applicant status
     */
    public function updateStatus(Request $request, Application $applicant)
    {
        $this->authorize('update', $applicant);

        $validated = $request->validate([
            'status' => ['required', 'in:applied,review,interview,hired,rejected'],
            'status_note' => ['nullable', 'string', 'max:1000'],
        ]);

        $applicant->update([
            'status' => $validated['status'],
            'status_note' => $validated['status_note'] ?? null,
        ]);

        // Send notification
        $applicant->user->notify(new ApplicationStatusChangedNotification($applicant));
        Mail::to($applicant->user->email)->send(new ApplicationStatusChangedMail($applicant));

        return back()->with('success', 'Status pelamar berhasil diperbarui dan notifikasi terkirim.');
    }

    /**
     * Download CV
     */
    public function downloadCv(Application $applicant)
    {
        $this->authorize('view', $applicant);

        if (!$applicant->cv_path || !Storage::exists($applicant->cv_path)) {
            return back()->with('error', 'CV tidak ditemukan.');
        }

        return Storage::download($applicant->cv_path, "{$applicant->user->name}_CV.pdf");
    }
}
