<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use App\Models\AdminLog;
use App\Models\Application;
use App\Models\Company;
use App\Models\Job;
use App\Models\User;
use App\Notifications\JobApprovedNotification;
use App\Notifications\JobSeekerSuspendedNotification;
use App\Services\AdminActivityLogger;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\StreamedResponse;

class AdminController extends Controller
{
    // ==================== DASHBOARD ====================
    
    public function dashboard()
    {
        $data = [
            'totalSeekers' => User::count(),
            'totalRecruiters' => Company::count(),
            'totalJobs' => Job::count(),
            'totalApplications' => Application::count(),
            'activeJobs' => Job::where('status', 'approved')->count(),
            'inactiveJobs' => Job::whereNotIn('status', ['approved'])->count(),
            'pendingCompanies' => Company::where('status', 'pending')->count(),
            'pendingJobs' => Job::where('status', 'pending')->count(),
            'popularJobs' => Job::where('status', 'approved')
                ->withCount('applications')
                ->orderByDesc('applications_count')
                ->limit(5)
                ->get(),
        ];

        return view('admin.dashboard', $data);
    }

    // ==================== COMPANIES ====================

    public function companies(Request $request)
    {
        $query = Company::query();

        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        if ($request->filled('search')) {
            $query->where('name', 'like', "%{$request->search}%")
                ->orWhere('email', 'like', "%{$request->search}%");
        }

        $companies = $query->latest()->paginate(15);

        return view('admin.companies', compact('companies'));
    }

    public function showCompany(Company $company)
    {
        $company->load('jobs');
        return view('admin.company-detail', compact('company'));
    }

    public function updateCompanyStatus(Request $request, Company $company)
    {
        $validated = $request->validate([
            'status' => ['required', 'in:pending,approved,rejected,suspended'],
        ]);

        $oldStatus = $company->status;
        $company->update(['status' => $validated['status']]);

        $admin = auth('admin')->user();
        AdminActivityLogger::log($admin, 'company.status.updated', $company, [
            'old_status' => $oldStatus,
            'new_status' => $validated['status'],
        ]);

        return back()->with('success', 'Status perusahaan diperbarui.');
    }

    // ==================== JOBS ====================

    public function jobs(Request $request)
    {
        $query = Job::with('company');

        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        if ($request->filled('location')) {
            $query->where('location', $request->location);
        }

        if ($request->filled('category')) {
            $query->where('category', $request->category);
        }

        if ($request->filled('search')) {
            $query->where('title', 'like', "%{$request->search}%")
                ->orWhere('description', 'like', "%{$request->search}%");
        }

        // Include soft deleted for admin view
        if ($request->boolean('include_deleted')) {
            $query->withTrashed();
        }

        $jobs = $query->latest()->paginate(15);

        return view('admin.jobs', compact('jobs'));
    }

    public function showJob(Job $job)
    {
        $job->load('company', 'applications');
        return view('admin.job-detail', compact('job'));
    }

    public function updateJobStatus(Request $request, Job $job)
    {
        $validated = $request->validate([
            'status' => ['required', 'in:pending,approved,rejected'],
        ]);

        $oldStatus = $job->status;
        $job->update(['status' => $validated['status']]);

        $admin = auth('admin')->user();
        AdminActivityLogger::log($admin, 'job.status.updated', $job, [
            'old_status' => $oldStatus,
            'new_status' => $validated['status'],
        ]);

        // Send notification to recruiter if job is approved
        if ($validated['status'] === 'approved') {
            $job->company->notify(new JobApprovedNotification($job));
        }

        return back()->with('success', 'Status lowongan diperbarui.');
    }

    public function toggleFeatured(Job $job)
    {
        $oldValue = $job->is_featured;
        $job->update(['is_featured' => !$job->is_featured]);

        $admin = auth('admin')->user();
        AdminActivityLogger::log($admin, 'job.featured.toggled', $job, [
            'old_value' => $oldValue,
            'new_value' => $job->is_featured,
        ]);

        return back()->with('success', 'Status unggulan lowongan diperbarui.');
    }

    public function deleteJob(Job $job)
    {
        $admin = auth('admin')->user();
        AdminActivityLogger::log($admin, 'job.deleted', $job);

        $job->delete();

        return back()->with('success', 'Lowongan telah dihapus.');
    }

    public function restoreJob(Job $job)
    {
        $admin = auth('admin')->user();
        AdminActivityLogger::log($admin, 'job.restored', $job);

        $job->restore();

        return back()->with('success', 'Lowongan telah dikembalikan.');
    }

    // ==================== USERS ====================

    public function users(Request $request)
    {
        $query = User::query();

        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        if ($request->filled('search')) {
            $query->where('name', 'like', "%{$request->search}%")
                ->orWhere('email', 'like', "%{$request->search}%");
        }

        $users = $query->latest()->paginate(15);

        return view('admin.users', compact('users'));
    }

    public function showUser(User $user)
    {
        $user->load('experiences', 'educations', 'applications');
        return view('admin.user-detail', compact('user'));
    }

    public function updateUserStatus(Request $request, User $user)
    {
        $validated = $request->validate([
            'status' => ['required', 'in:active,suspended'],
        ]);

        $oldStatus = $user->status;
        $user->update(['status' => $validated['status']]);

        $admin = auth('admin')->user();
        AdminActivityLogger::log($admin, 'user.status.updated', $user, [
            'old_status' => $oldStatus,
            'new_status' => $validated['status'],
        ]);

        // Send notification if suspended
        if ($validated['status'] === 'suspended') {
            $user->notify(new JobSeekerSuspendedNotification(
                'Akun Anda telah ditangguhkan oleh admin.'
            ));
        }

        return back()->with('success', 'Status pengguna diperbarui.');
    }

    public function deleteUser(User $user)
    {
        $admin = auth('admin')->user();
        AdminActivityLogger::log($admin, 'user.deleted', $user);

        $user->delete();

        return back()->with('success', 'Pengguna telah dihapus.');
    }

    public function restoreUser(User $user)
    {
        $admin = auth('admin')->user();
        AdminActivityLogger::log($admin, 'user.restored', $user);

        $user->restore();

        return back()->with('success', 'Pengguna telah dikembalikan.');
    }

    // ==================== APPLICATIONS ====================

    public function applications(Request $request)
    {
        $query = Application::with('user', 'job');

        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        if ($request->filled('search')) {
            $query->whereHas('user', function ($q) use ($request) {
                $q->where('name', 'like', "%{$request->search}%");
            })->orWhereHas('job', function ($q) use ($request) {
                $q->where('title', 'like', "%{$request->search}%");
            });
        }

        $applications = $query->latest()->paginate(15);

        return view('admin.applications', compact('applications'));
    }

    public function downloadApplicationCv(Application $application)
    {
        $media = $application->user->getMedia('cv');
        if ($media->isEmpty()) {
            return back()->with('error', 'CV tidak ditemukan.');
        }

        return response()->download($media->first()->getPath(), $media->first()->file_name);
    }

    // ==================== REPORTS & ANALYTICS ====================

    public function reports()
    {
        $data = [
            'topJobs' => Job::where('status', 'approved')
                ->withCount('applications')
                ->orderByDesc('applications_count')
                ->limit(10)
                ->get(),
            'topCompanies' => Company::whereHas('jobs')
                ->withCount(['jobs', 'jobs.applications'])
                ->orderByDesc('jobs_count')
                ->limit(10)
                ->get(),
            'topUsers' => User::withCount('applications')
                ->orderByDesc('applications_count')
                ->limit(10)
                ->get(),
        ];

        return view('admin.reports', $data);
    }

    public function exportReportsCsv(): StreamedResponse
    {
        $headers = [
            'Content-Type' => 'text/csv; charset=utf-8',
            'Content-Disposition' => 'attachment; filename=admin_reports_' . now()->format('Y-m-d') . '.csv',
        ];

        return response()->stream(function () {
            $handle = fopen('php://output', 'w');
            fputcsv($handle, ['Tipe', 'Nama/Judul', 'Total']);

            // Top Jobs
            fputcsv($handle, []);
            fputcsv($handle, ['Lowongan Teratas (Berdasarkan Jumlah Lamaran)']);
            fputcsv($handle, ['No.', 'Judul', 'Lamaran']);

            $jobs = Job::where('status', 'approved')
                ->withCount('applications')
                ->orderByDesc('applications_count')
                ->limit(10)
                ->get();

            $no = 1;
            foreach ($jobs as $job) {
                fputcsv($handle, [$no++, $job->title, $job->applications_count]);
            }

            // Top Companies
            fputcsv($handle, []);
            fputcsv($handle, ['Perusahaan Teratas (Berdasarkan Jumlah Lowongan)']);
            fputcsv($handle, ['No.', 'Nama', 'Lowongan', 'Lamaran']);

            $companies = Company::whereHas('jobs')
                ->withCount(['jobs', 'jobs.applications'])
                ->orderByDesc('jobs_count')
                ->limit(10)
                ->get();

            $no = 1;
            foreach ($companies as $company) {
                fputcsv($handle, [$no++, $company->name, $company->jobs_count, $company->jobs_applications_count ?? 0]);
            }

            // Top Users
            fputcsv($handle, []);
            fputcsv($handle, ['Pencari Kerja Teratas (Berdasarkan Jumlah Lamaran)']);
            fputcsv($handle, ['No.', 'Nama', 'Lamaran']);

            $users = User::withCount('applications')
                ->orderByDesc('applications_count')
                ->limit(10)
                ->get();

            $no = 1;
            foreach ($users as $user) {
                fputcsv($handle, [$no++, $user->name, $user->applications_count]);
            }

            fclose($handle);
        }, 200, $headers);
    }

    // ==================== ACTIVITY LOGS ====================

    public function logs(Request $request)
    {
        $query = AdminLog::with('admin');

        if ($request->filled('admin_id')) {
            $query->where('admin_id', $request->admin_id);
        }

        if ($request->filled('action')) {
            $query->where('action', 'like', "%{$request->action}%");
        }

        $logs = $query->latest()->paginate(50);

        return view('admin.logs', compact('logs'));
    }
}
