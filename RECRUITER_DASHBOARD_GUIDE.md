# RECRUITER DASHBOARD - UI/UX IMPLEMENTATION GUIDE

## 📋 Overview
Panduan lengkap implementasi Recruiter Dashboard yang profesional, modern, dan konsisten dengan design system Job Board application berbasis Laravel 12 + Tailwind CSS.

## 🗂️ Struktur Folder
```
resources/views/recruiter/
├── dashboard.blade.php          (Dashboard overview & statistik)
├── jobs/
│   ├── index.blade.php         (List semua lowongan)
│   ├── create.blade.php        (Form tambah lowongan baru)
│   ├── edit.blade.php          (Form edit lowongan)
│   └── show.blade.php          (Detail lowongan)
├── applicants/
│   ├── index.blade.php         (List pelamar dengan filter)
│   └── show.blade.php          (Detail profil pelamar)
└── profile/
    └── edit.blade.php          (Edit profile perusahaan)
```

## 📊 1. DASHBOARD OVERVIEW

### Fitur
- **4 Statistic Cards**
  - Total Lowongan
  - Lowongan Aktif
  - Total Pelamar
  - Pelamar Hari Ini

- **Lowongan Terbaru**
  - 5 lowongan terbaru
  - Quick view status
  - Click untuk lihat detail

- **Status Distribution Chart**
  - Progress bar status pelamar
  - Applied, Review, Interview, Hired

- **Pending Approvals**
  - Lowongan menunggu approval admin
  - Warning badge

### Endpoint
```php
GET /recruiter/dashboard
```

### Data yang Dibutuhkan
```php
$totalJobs = Job::where('company_id', auth()->user()->id)->count();
$activeJobs = Job::where('company_id', auth()->user()->id)->where('status', 'active')->count();
$totalApplicants = Application::whereHas('job', function($q) {
    $q->where('company_id', auth()->user()->id);
})->count();
$todayApplicants = Application::whereHas('job', function($q) {
    $q->where('company_id', auth()->user()->id);
})->whereDate('created_at', today())->count();
$recentJobs = Job::where('company_id', auth()->user()->id)->latest()->take(5)->get();
$pendingJobs = Job::where('company_id', auth()->user()->id)->where('status', 'pending')->get();
```

## 🏢 2. LOWONGAN MANAGEMENT

### 2.1 List Lowongan (index.blade.php)

**Fitur:**
- Filter & Search
  - Cari by judul/deskripsi
  - Filter by status (Active, Inactive, Pending, Closed)
- Job Card List
  - Judul, deskripsi (limit 150 char)
  - Lokasi, tipe kerja, salary range
  - Jumlah pelamar
  - Status badge
- Actions per job
  - Lihat Pelamar
  - Edit
  - Hapus

**Endpoint:**
```php
GET  /recruiter/jobs                    // List dengan pagination
GET  /recruiter/jobs?search=...         // Search
GET  /recruiter/jobs?status=...         // Filter status
```

### 2.2 Tambah Lowongan (create.blade.php)

**Form Fields:**
- Judul lowongan (required)
- Tipe pekerjaan dropdown (required)
- Lokasi (required)
- Gaji minimum (optional)
- Gaji maksimum (optional)
- Deskripsi (textarea, required)
- Requirements (textarea, required)
- Deadline (date, required)

**UI:**
- Form inputs dengan focus ring biru
- Textarea besar untuk deskripsi
- Validation error messages per field
- Info box dengan tips membuat lowongan

**Endpoint:**
```php
GET  /recruiter/jobs/create             // Show form
POST /recruiter/jobs                    // Store
```

### 2.3 Edit Lowongan (edit.blade.php)

**Layout:** Sama dengan create, tapi pre-filled dengan data existing

**Endpoint:**
```php
GET    /recruiter/jobs/{id}/edit        // Show form
PUT    /recruiter/jobs/{id}             // Update
```

### 2.4 Delete Lowongan

**Confirmation:** JavaScript confirmation dialog sebelum delete

**Endpoint:**
```php
DELETE /recruiter/jobs/{id}             // Delete
```

---

## 👥 3. PELAMAR MANAGEMENT

### 3.1 List Pelamar (applicants/index.blade.php)

**Fitur:**
- Filter & Search
  - Cari by nama/email pelamar
  - Filter by status (Applied, Review, Interview, Hired, Rejected)
  - Filter by lowongan
- Applicant Card List
  - Avatar dengan initial nama
  - Nama + lowongan yang dilamar
  - Email, phone (jika ada)
  - Waktu melamar
  - Status badge
- Actions per pelamar
  - Lihat Detail
  - Update Status (modal)
  - Download CV

**Endpoint:**
```php
GET /recruiter/applicants                   // List dengan pagination
GET /recruiter/applicants?search=...        // Search
GET /recruiter/applicants?status=...        // Filter status
GET /recruiter/applicants?job_id=...        // Filter job
```

### 3.2 Status Update Modal

**Fitur:**
- Dropdown status baru (5 pilihan)
- Text area untuk notes/catatan
- Konfirmasi save

**Validasi:**
- Status harus valid
- Notes optional

**Endpoint:**
```php
PATCH /recruiter/applicants/{id}/status    // Update status
```

---

## 📄 4. DETAIL PELAMAR

### Fitur
**Left Sidebar:**
- Avatar dengan initial
- Nama, email, phone
- Waktu melamar
- Download CV button
- Skills badges

**Main Content:**
- About/Bio section
- Pengalaman kerja (timeline)
  - Posisi, perusahaan
  - Start-End date
  - Deskripsi
- Pendidikan
  - Sekolah/Universitas
  - Degree, field
  - Tahun
- Cover letter

**Actions:**
- Update Status button
- Download CV button

**Endpoint:**
```php
GET /recruiter/applicants/{id}         // Show detail
```

---

## 🏢 5. PROFILE PERUSAHAAN

### Form Fields
- Logo upload (preview)
- Nama perusahaan
- Website
- Lokasi
- Industri dropdown
- Ukuran perusahaan dropdown
- Deskripsi perusahaan (textarea)

**Contact Section:**
- Nama kontak (PIC)
- Telepon kontak

**Danger Zone:**
- Delete account button

**Endpoint:**
```php
GET   /recruiter/profile/edit           // Show form
PUT   /recruiter/profile                // Update
DELETE /recruiter/profile               // Delete account
```

---

## 🎨 6. UI COMPONENTS USED

### Component Status Badge
```blade
<x-status-badge status="applied" />      <!-- Default lg -->
<x-status-badge status="applied" size="sm" />
```

**Status Colors:**
- applied → blue
- review → yellow
- interview → purple
- hired → green
- rejected → red
- pending → yellow
- active → green
- inactive → gray
- suspended → red

### Component Stat Card
```blade
<x-stat-card 
    title="Total Lowongan"
    value="12"
    icon="briefcase"
    trend="+2 bulan ini"
    trendType="positive"
/>
```

### Component Skeleton
```blade
<x-skeleton type="card" count="3" />     <!-- Loading 3 cards -->
<x-skeleton type="line" count="5" />     <!-- Loading 5 lines -->
<x-skeleton type="table" />              <!-- Loading table -->
```

### Component Empty State
```blade
<x-empty-state 
    title="Tidak Ada Lowongan"
    description="Mulai posting lowongan..."
    icon="briefcase"
    buttonText="Buat Lowongan Baru"
    buttonUrl="{{ route('recruiter.jobs.create') }}"
/>
```

### Component Toast
```blade
<x-toast message="Berhasil menyimpan!" type="success" />
<x-toast message="Terjadi kesalahan" type="error" />
```

### Component Modal
```blade
<x-modal id="statusModal" title="Update Status" size="md">
    <!-- Isi form -->
</x-modal>

<script>
    function openStatusModal(id) {
        document.getElementById('statusModal').classList.remove('hidden');
    }
</script>
```

---

## ⚙️ 7. SIDEBAR NAVIGATION

**Menu Items:**
- Dashboard (icon: chart-bar)
- Lowongan Saya (icon: briefcase)
- Tambah Lowongan (icon: document-text)
- Pelamar (icon: users)
- Profil Perusahaan (icon: building-office-2)

**Active State:** bg-blue-100 text-blue-600

---

## 🔒 8. SECURITY & VALIDATION

### Authorization
- Recruiter hanya bisa lihat data lowongan miliknya
- Recruiter hanya bisa lihat pelamar untuk lowongan miliknya
- Edit/Delete hanya untuk pemilik lowongan

### Validation
```php
// Jobs
$validated = $request->validate([
    'title' => 'required|string|max:255',
    'job_type' => 'required|in:Full-time,Part-time,Contract,Freelance',
    'location' => 'required|string|max:255',
    'salary_min' => 'nullable|integer|min:0',
    'salary_max' => 'nullable|integer|min:0',
    'description' => 'required|string|min:50',
    'requirements' => 'required|string|min:50',
    'deadline' => 'required|date|after:today',
]);

// Profile
$validated = $request->validate([
    'name' => 'required|string|max:255',
    'website' => 'nullable|url',
    'location' => 'required|string|max:255',
    'industry' => 'required|string',
    'company_size' => 'required|string',
    'description' => 'nullable|string',
    'logo' => 'nullable|image|max:2048',
    'contact_name' => 'required|string|max:255',
    'contact_phone' => 'required|string|max:20',
]);
```

---

## 📱 9. RESPONSIVE DESIGN

**Mobile (< 768px)**
- Sidebar collapse/hamburger
- Table → scroll horizontal
- Grid columns → 1 column
- Card actions → vertical stack

**Tablet (768px - 1024px)**
- Sidebar visible
- Grid columns → 2
- Table still scrollable

**Desktop (> 1024px)**
- Full layout
- Grid columns → 3-4
- All content visible

---

## 🎯 10. ROUTING SETUP

```php
// routes/web.php
Route::middleware(['auth:recruiter'])->prefix('recruiter')->name('recruiter.')->group(function () {
    // Dashboard
    Route::get('/dashboard', [RecruiterDashboardController::class, 'index'])->name('dashboard');
    
    // Jobs
    Route::resource('jobs', RecruiterJobController::class);
    
    // Applicants
    Route::get('/applicants', [RecruiterApplicantController::class, 'index'])->name('applicants.index');
    Route::get('/applicants/{id}', [RecruiterApplicantController::class, 'show'])->name('applicants.show');
    Route::patch('/applicants/{id}/status', [RecruiterApplicantController::class, 'updateStatus'])->name('applicants.status');
    
    // Profile
    Route::get('/profile/edit', [RecruiterProfileController::class, 'edit'])->name('profile.edit');
    Route::put('/profile', [RecruiterProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [RecruiterProfileController::class, 'destroy'])->name('profile.destroy');
});
```

---

## 📋 11. IMPLEMENTATION CHECKLIST

### Controllers
- [ ] RecruiterDashboardController
- [ ] RecruiterJobController (CRUD)
- [ ] RecruiterApplicantController
- [ ] RecruiterProfileController

### Views
- [ ] recruiter/dashboard.blade.php
- [ ] recruiter/jobs/index.blade.php
- [ ] recruiter/jobs/create.blade.php
- [ ] recruiter/jobs/edit.blade.php
- [ ] recruiter/applicants/index.blade.php
- [ ] recruiter/applicants/show.blade.php
- [ ] recruiter/profile/edit.blade.php

### Components
- [ ] x-status-badge
- [ ] x-stat-card
- [ ] x-skeleton
- [ ] x-toast

### Routes
- [ ] All recruiter routes registered

### Migrations (jika diperlukan)
- [ ] Add columns to jobs table
- [ ] Add columns to applications table
- [ ] Add columns to companies table

---

## 🚀 12. PERFORMANCE OPTIMIZATION

### Eager Loading
```php
Job::with('company', 'applications.job_seeker')->get();
Application::with('job', 'job_seeker', 'job_seeker.skills')->get();
```

### Pagination
```php
$jobs = Job::where('company_id', auth()->user()->id)->paginate(15);
```

### Caching
```php
cache()->remember("recruiter_stats_{$companyId}", 3600, function() {
    // Retrieve stats
});
```

---

## 💡 13. TIPS & BEST PRACTICES

1. **Always use Heroicons** - untuk consistency
2. **Validate on both sides** - frontend & backend
3. **Use Tailwind classes** - jangan hardcode styling
4. **Add loading states** - gunakan skeleton component
5. **Confirm destructive actions** - sebelum delete
6. **Show toast notifications** - untuk user feedback
7. **Use proper spacing** - space-y-4, gap-6, etc
8. **Test responsive** - di semua breakpoints
9. **Add accessibility** - proper labels, ARIA
10. **Keep it DRY** - gunakan components & partials

---

## 📞 Support
Jika ada pertanyaan tentang implementasi, referensikan dokumentasi:
- Design System: `resources/css/design-system.css`
- Components: `resources/views/components/`
- Layout: `resources/views/layouts/recruiter.blade.php`
