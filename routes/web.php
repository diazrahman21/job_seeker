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

Route::middleware('auth:job_seeker')->prefix('job-seeker')->name('job-seeker.')->group(function () {
    Route::get('/dashboard', [JobSeekerController::class, 'dashboard'])->name('dashboard');
    Route::get('/profile', [JobSeekerController::class, 'profile'])->name('profile');
    Route::post('/profile', [JobSeekerController::class, 'updateProfile'])->name('profile.update');
    Route::post('/profile/experience', [JobSeekerController::class, 'addExperience'])->name('experience.add');
    Route::post('/profile/education', [JobSeekerController::class, 'addEducation'])->name('education.add');
    Route::post('/profile/cv', [JobSeekerController::class, 'uploadCv'])->name('cv.upload');
    Route::delete('/profile/cv/{mediaId}', [JobSeekerController::class, 'removeCv'])->name('cv.delete');
    Route::get('/jobs', [JobSeekerController::class, 'jobs'])->name('jobs');
    Route::get('/jobs/{job}', [JobSeekerController::class, 'detail'])->name('jobs.detail');
    Route::post('/jobs/{job}/apply', [JobSeekerController::class, 'apply'])->name('jobs.apply');
    Route::post('/jobs/{job}/bookmark', [JobSeekerController::class, 'toggleBookmark'])->name('jobs.bookmark');
    Route::get('/bookmarks', [JobSeekerController::class, 'bookmarks'])->name('bookmarks');
});

Route::middleware('auth:recruiter')->prefix('recruiter')->name('recruiter.')->group(function () {
    Route::get('/dashboard', [RecruiterController::class, 'dashboard'])->name('dashboard');
    Route::get('/jobs', [RecruiterController::class, 'jobs'])->name('jobs');
    Route::get('/jobs/create', [RecruiterController::class, 'createJob'])->name('jobs.create');
    Route::post('/jobs', [RecruiterController::class, 'storeJob'])->name('jobs.store');
    Route::get('/jobs/{job}/edit', [RecruiterController::class, 'editJob'])->name('jobs.edit');
    Route::put('/jobs/{job}', [RecruiterController::class, 'updateJob'])->name('jobs.update');
    Route::delete('/jobs/{job}', [RecruiterController::class, 'destroyJob'])->name('jobs.delete');
    Route::get('/jobs/{job}/applicants', [RecruiterController::class, 'applicants'])->name('jobs.applicants');
    Route::put('/applications/{application}/status', [RecruiterController::class, 'updateApplicationStatus'])->name('applications.status');
    Route::get('/applications/{application}/cv', [RecruiterController::class, 'downloadCv'])->name('applications.cv');
});

Route::middleware('auth:admin')->prefix('admin')->name('admin.')->group(function () {
    Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('dashboard');
    Route::get('/companies', [AdminController::class, 'companies'])->name('companies');
    Route::put('/companies/{company}/status', [AdminController::class, 'updateCompanyStatus'])->name('companies.status');
    Route::get('/jobs', [AdminController::class, 'jobs'])->name('jobs');
    Route::put('/jobs/{job}/status', [AdminController::class, 'updateJobStatus'])->name('jobs.status');
});
