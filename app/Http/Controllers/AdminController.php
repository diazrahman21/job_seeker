<?php

namespace App\Http\Controllers;

use App\Models\Company;
use App\Models\Job;
use App\Models\User;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function dashboard()
    {
        return view('admin.dashboard', [
            'totalCompanies' => Company::count(),
            'pendingCompanies' => Company::where('status', 'pending')->count(),
            'totalJobs' => Job::count(),
            'pendingJobs' => Job::where('status', 'pending')->count(),
            'totalSeekers' => User::count(),
        ]);
    }

    public function companies()
    {
        return view('admin.companies', [
            'companies' => Company::latest()->cursorPaginate(15),
        ]);
    }

    public function updateCompanyStatus(Request $request, Company $company)
    {
        $validated = $request->validate([
            'status' => ['required', 'in:approved,rejected,pending'],
        ]);

        $company->update(['status' => $validated['status']]);

        return back()->with('success', 'Status perusahaan diperbarui.');
    }

    public function jobs()
    {
        return view('admin.jobs', [
            'jobs' => Job::with('company')->latest()->cursorPaginate(15),
        ]);
    }

    public function updateJobStatus(Request $request, Job $job)
    {
        $validated = $request->validate([
            'status' => ['required', 'in:approved,rejected,pending'],
        ]);

        $job->update(['status' => $validated['status']]);

        return back()->with('success', 'Status lowongan diperbarui.');
    }
}
