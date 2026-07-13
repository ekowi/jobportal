# JobPortal — Laravel 11 full-stack job board

A production-ready job board application built with Laravel 11. Job seekers
browse and apply to listings; employers post jobs and manage applicants.
Designed to demonstrate end-to-end Laravel patterns: authentication,
authorization, file uploads, queued jobs, and a clean Blade + Tailwind UI.

---

## ✨ Features

- **Role-based auth** — separate dashboards for job seekers and employers (Laravel Breeze + custom guards).
- **Job listings** — CRUD with search, filter by category/location/type, and pagination.
- **Application flow** — job seekers apply with CV upload (PDF/DOC, validated MIME + size limit); employers review and shortlist.
- **Employer dashboard** — post jobs, view applicants, export to CSV.
- **Seeker dashboard** — saved jobs, application history, profile + resume.
- **Email notifications** — queued (`ShouldQueue`) on application received + status changes.

---

## 🧰 Tech stack

| Layer | Choice |
|---|---|
| Framework | Laravel 11 (PHP 8.3) |
| Auth | Laravel Breeze (Blade) — custom role middleware |
| Database | MySQL 8 (Eloquent ORM, migrations, seeders) |
| Frontend | Blade templates + Tailwind CSS + Alpine.js |
| Queue | Database driver (upgradeable to Redis) |
| Mail | SMTP via `log` driver in dev, real provider in prod |
| File storage | Local `storage/app/public` (S3-compatible swap possible) |

---

## 🚀 Getting started

### 1. Clone & install

```bash
git clone https://github.com/ekowi/jobportal.git
cd jobportal
composer install
npm install
cp .env.example .env
php artisan key:generate
```

### 2. Configure database

Edit `.env`:

```bash
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=jobportal
DB_USERNAME=root
DB_PASSWORD=
```

Then migrate + seed:

```bash
php artisan migrate --seed
```

The seeder creates two test accounts — employer `employer@example.com` and
seeker `seeker@example.com`, both password `password`.

### 3. Run

```bash
php artisan serve          # http://localhost:8000
npm run dev                # Vite dev server for Tailwind/Alpine HMR
php artisan queue:work     # process queued emails (separate terminal)
```

---

## 🗄️ Schema overview

```
users           ─┬─ jobs (employer_id)
                 └─ applications (job_id, user_id, cv_path, status)

jobs            ──── categories, locations, employment_types
applications    ──── statuses: pending | reviewed | shortlisted | rejected
```

Migrations live in `database/migrations/`. Eloquent relationships are
documented in `app/Models/`.

---

## 📦 Deployment notes

- Run `php artisan config:cache route:cache view:cache` in production.
- Set `APP_DEBUG=false` and configure a real mail driver (`MAIL_MAILER=smtp`).
- For queues in production, swap `QUEUE_CONNECTION=database` to `redis` or
  use Laravel Horizon for monitoring.
- File uploads go to `storage/app/public` — run `php artisan storage:link` and
  put that directory behind your reverse proxy with proper caching headers.

---

## 📝 License

MIT — see `LICENSE`.

---

<sub>Part of my [GitHub profile portfolio](https://github.com/ekowi). Built as a
Laravel reference project to demonstrate patterns I apply in freelance work.</sub>