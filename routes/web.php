<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\JobSeekerController;
use App\Http\Controllers\PortalAuthController;
use App\Http\Controllers\RecruiterController;
use Illuminate\Support\Facades\Route;

Route::view('/', 'welcome')->name('home');

Route::middleware('guest:job_seeker')->group(function () {
    Route::get('/job-seeker/login', [PortalAuthController::class, 'showJobSeekerLogin'])->name('job-seeker.login');
    Route::post('/job-seeker/login', [PortalAuthController::class, 'jobSeekerLogin']);
    Route::get('/job-seeker/register', [PortalAuthController::class, 'showJobSeekerRegister'])->name('job-seeker.register');
    Route::post('/job-seeker/register', [PortalAuthController::class, 'jobSeekerRegister']);
});

Route::middleware('auth:job_seeker')->group(function () {
    Route::get('/otp-verification', [PortalAuthController::class, 'showOtpVerification'])->name('otp.verification.notice');
    Route::post('/otp-verification', [PortalAuthController::class, 'verifyOtp'])->name('otp.verification.verify');
    Route::post('/otp-verification/resend', [PortalAuthController::class, 'resendOtp'])->name('otp.verification.resend');
});

Route::middleware('guest:recruiter')->group(function () {
    Route::get('/recruiter/login', [PortalAuthController::class, 'showRecruiterLogin'])->name('recruiter.login');
    Route::post('/recruiter/login', [PortalAuthController::class, 'recruiterLogin']);
    Route::get('/recruiter/register', [PortalAuthController::class, 'showRecruiterRegister'])->name('recruiter.register');
    Route::post('/recruiter/register', [PortalAuthController::class, 'recruiterRegister']);
});

Route::middleware('guest:admin')->group(function () {
    Route::get('/admin/login', [PortalAuthController::class, 'showAdminLogin'])->name('admin.login');
    Route::post('/admin/login', [PortalAuthController::class, 'adminLogin']);
});

Route::post('/logout', [PortalAuthController::class, 'logout'])->name('logout');

// Public routes
Route::get('/companies/{company}', [JobSeekerController::class, 'viewCompanyProfile'])->name('companies.profile');

Route::middleware('auth:job_seeker')->prefix('job-seeker')->name('job-seeker.')->group(function () {
    Route::get('/profile', [JobSeekerController::class, 'profile'])->name('profile');
    Route::post('/profile', [JobSeekerController::class, 'updateProfile'])->name('profile.update');
    Route::post('/profile/experience', [JobSeekerController::class, 'addExperience'])->name('experience.add');
    Route::post('/profile/education', [JobSeekerController::class, 'addEducation'])->name('education.add');
    Route::post('/profile/cv', [JobSeekerController::class, 'uploadCv'])->name('cv.upload');
    Route::delete('/profile/cv/{mediaId}', [JobSeekerController::class, 'removeCv'])->name('cv.delete');
    Route::get('/jobs', [JobSeekerController::class, 'jobs'])->name('jobs');
    Route::get('/jobs/{job}', [JobSeekerController::class, 'detail'])->name('jobs.detail');
});

Route::middleware(['auth:job_seeker', 'verified'])->prefix('job-seeker')->name('job-seeker.')->group(function () {
    Route::get('/dashboard', [JobSeekerController::class, 'dashboard'])->name('dashboard');
    Route::post('/jobs/{job}/apply', [JobSeekerController::class, 'apply'])->name('jobs.apply');
    Route::post('/jobs/{job}/bookmark', [JobSeekerController::class, 'toggleBookmark'])->name('jobs.bookmark');
    Route::get('/bookmarks', [JobSeekerController::class, 'bookmarks'])->name('bookmarks');
});

Route::middleware('auth:recruiter')->prefix('recruiter')->name('recruiter.')->group(function () {
    Route::get('/dashboard', [RecruiterController::class, 'dashboard'])->name('dashboard');
    
    // Jobs Resource Routes
    Route::resource('jobs', \App\Http\Controllers\RecruiterJobController::class);
    
    // Applicants Routes
    Route::prefix('applicants')->name('applicants.')->group(function () {
        Route::get('/', [\App\Http\Controllers\RecruiterApplicantController::class, 'index'])->name('index');
        Route::get('/{applicant}', [\App\Http\Controllers\RecruiterApplicantController::class, 'show'])->name('show');
        Route::patch('/{applicant}/status', [\App\Http\Controllers\RecruiterApplicantController::class, 'updateStatus'])->name('status');
        Route::get('/{applicant}/cv', [\App\Http\Controllers\RecruiterApplicantController::class, 'downloadCv'])->name('cv');
    });
    
    // Profile Routes
    Route::prefix('profile')->name('profile.')->group(function () {
        Route::get('/edit', [\App\Http\Controllers\RecruiterProfileController::class, 'edit'])->name('edit');
        Route::put('/', [\App\Http\Controllers\RecruiterProfileController::class, 'update'])->name('update');
        Route::delete('/', [\App\Http\Controllers\RecruiterProfileController::class, 'destroy'])->name('destroy');
    });
});

Route::middleware('auth:admin')->prefix('admin')->name('admin.')->group(function () {
    // Dashboard
    Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('dashboard');

    // Companies
    Route::get('/companies', [AdminController::class, 'companies'])->name('companies');
    Route::get('/companies/{company}', [AdminController::class, 'showCompany'])->name('companies.show');
    Route::put('/companies/{company}/status', [AdminController::class, 'updateCompanyStatus'])->name('companies.status');

    // Jobs
    Route::get('/jobs', [AdminController::class, 'jobs'])->name('jobs');
    Route::get('/jobs/{job}', [AdminController::class, 'showJob'])->name('jobs.show');
    Route::put('/jobs/{job}/status', [AdminController::class, 'updateJobStatus'])->name('jobs.status');
    Route::put('/jobs/{job}/featured', [AdminController::class, 'toggleFeatured'])->name('jobs.featured');
    Route::delete('/jobs/{job}', [AdminController::class, 'deleteJob'])->name('jobs.delete');
    Route::post('/jobs/{job}/restore', [AdminController::class, 'restoreJob'])->name('jobs.restore');

    // Users
    Route::get('/users', [AdminController::class, 'users'])->name('users');
    Route::get('/users/{user}', [AdminController::class, 'showUser'])->name('users.show');
    Route::put('/users/{user}/status', [AdminController::class, 'updateUserStatus'])->name('users.status');
    Route::delete('/users/{user}', [AdminController::class, 'deleteUser'])->name('users.delete');
    Route::post('/users/{user}/restore', [AdminController::class, 'restoreUser'])->name('users.restore');

    // Applications
    Route::get('/applications', [AdminController::class, 'applications'])->name('applications');
    Route::get('/applications/{application}/cv', [AdminController::class, 'downloadApplicationCv'])->name('applications.cv');

    // Reports
    Route::get('/reports', [AdminController::class, 'reports'])->name('reports');
    Route::get('/reports/export-csv', [AdminController::class, 'exportReportsCsv'])->name('reports.export');

    // Activity Logs
    Route::get('/logs', [AdminController::class, 'logs'])->name('logs');
});
