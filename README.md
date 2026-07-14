# Zaouali Transport

Plain PHP transport request website with a Supabase Postgres backend and an
admin dashboard.

## Requirements

- PHP 8.1+ with `pdo_pgsql`
- Composer
- Supabase project

## Local setup

```bash
composer install
php scripts/check-supabase.php
php -S localhost:8000 -t public public/dev-router.php
```

Copy `.env.example` to `.env` and fill in the Supabase database settings before
running the app locally.

## Vercel

This project includes `vercel.json` and uses the community `vercel-php` runtime.
Set the required environment variables in Vercel Project Settings, then deploy.

See `SETUP.txt` for the full environment variable list.
