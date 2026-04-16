<?php

namespace App\Http\Controllers;

use App\Models\Job;
use Illuminate\Http\Request;

class RecruiterJobController extends Controller
{
    /**
     * Display a listing of jobs
     */
    public function index(Request $request)
    {
        $company = auth('recruiter')->user();
        
        $query = $company->jobs();

        // Search by title or description
        if ($request->filled('search')) {
            $search = $request->input('search');
            $query->where(function ($q) use ($search) {
                $q->where('title', 'like', "%{$search}%")
                    ->orWhere('description', 'like', "%{$search}%");
            });
        }

        // Filter by status
        if ($request->filled('status')) {
            $query->where('status', $request->input('status'));
        }

        $jobs = $query->withCount('applications')->latest()->paginate(15);

        return view('recruiter.jobs.index', compact('jobs'));
    }

    /**
     * Show the form for creating a new job
     */
    public function create()
    {
        return view('recruiter.jobs.create');
    }

    /**
     * Store a newly created job
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => ['required', 'string', 'max:255'],
            'employment_type' => ['required', 'in:Full-time,Part-time,Contract,Freelance'],
            'location' => ['required', 'string', 'max:255'],
            'salary_min' => ['nullable', 'integer', 'min:0'],
            'salary_max' => ['nullable', 'integer', 'min:0'],
            'description' => ['required', 'string', 'min:50'],
            'requirements' => ['required', 'string', 'min:50'],
            'deadline_at' => ['required', 'date', 'after:today'],
        ]);

        $validated['company_id'] = auth('recruiter')->id();
        $validated['status'] = 'pending';

        Job::create($validated);

        return redirect()->route('recruiter.jobs.index')->with('success', 'Lowongan berhasil dibuat dan menunggu persetujuan admin.');
    }

    /**
     * Display a job detail
     */
    public function show(Job $job)
    {
        $this->authorize('view', $job);
        
        $job->load('applications.user');
        
        return view('recruiter.jobs.show', compact('job'));
    }

    /**
     * Show the form for editing a job
     */
    public function edit(Job $job)
    {
        $this->authorize('update', $job);
        return view('recruiter.jobs.edit', compact('job'));
    }

    /**
     * Update a job
     */
    public function update(Request $request, Job $job)
    {
        $this->authorize('update', $job);

        $validated = $request->validate([
            'title' => ['required', 'string', 'max:255'],
            'employment_type' => ['required', 'in:Full-time,Part-time,Contract,Freelance'],
            'location' => ['required', 'string', 'max:255'],
            'salary_min' => ['nullable', 'integer', 'min:0'],
            'salary_max' => ['nullable', 'integer', 'min:0'],
            'description' => ['required', 'string', 'min:50'],
            'requirements' => ['required', 'string', 'min:50'],
            'deadline_at' => ['required', 'date', 'after_or_equal:today'],
        ]);

        $validated['status'] = 'pending';
        $job->update($validated);

        return redirect()->route('recruiter.jobs.index')->with('success', 'Lowongan berhasil diperbarui.');
    }

    /**
     * Delete a job
     */
    public function destroy(Job $job)
    {
        $this->authorize('delete', $job);
        $job->delete();

        return back()->with('success', 'Lowongan berhasil dihapus.');
    }
}
