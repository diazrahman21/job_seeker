# Job Board & Recruitment App (Laravel 12)

Aplikasi Job Board dengan 3 portal:
- Job Seeker
- Recruiter (Company)
- Admin

## Fitur Utama

### Portal Pelamar
- Register/login terpisah
- Profil pelamar: bio, skills, pengalaman, pendidikan, foto
- Upload/kelola CV PDF dengan Spatie Media Library
- Cari/filter lowongan real-time via Livewire
- Detail lowongan + Lamar Sekarang
- Status lamaran: applied/review/interview/rejected/hired
- Bookmark lowongan

### Portal Rekruter
- Register perusahaan
- CRUD lowongan kerja
- Lihat pelamar per lowongan + download CV
- Update status lamaran
- Notifikasi email + in-app saat status berubah
- Dashboard metrik recruiter

### Portal Admin
- Moderasi perusahaan (approve/reject)
- Moderasi lowongan (approve/reject)
- Statistik platform

## Tech Stack
- Laravel 12
- Tailwind CSS
- Livewire
- PostgreSQL
- Spatie Media Library
- Laravel Notifications + Mailables

## Setup

1. Install dependency:

```bash
composer install
npm install
```

2. Copy env dan set PostgreSQL:

```bash
cp .env.example .env
```

Contoh konfigurasi:

```env
DB_CONNECTION=pgsql
DB_HOST=127.0.0.1
DB_PORT=5432
DB_DATABASE=job_board
DB_USERNAME=postgres
DB_PASSWORD=postgres
```

3. Generate key dan migrate:

```bash
php artisan key:generate
php artisan migrate
php artisan db:seed
php artisan storage:link
```

4. Jalankan aplikasi:

```bash
php artisan serve
npm run dev
```

## Dummy Account
- Admin: admin@jobboard.test / password123
- Company & Job Seeker: dibuat dari seeder (password default: password123)

## Catatan
- Seeder membuat: 10 perusahaan, 30 lowongan, 20 pelamar dummy.
- CV disimpan via media collection `cvs`.
- Filtering lowongan memakai cursor pagination untuk performa.
