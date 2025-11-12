# VetLink

A modern, multi-tenant CRM for veterinary practices — scheduling clients & patients, invoicing, medical documents, offers, orders, and more. Built with **Laravel 12**, **Filament 4**, and **Flux UI v2**.


## Features

* Appointments: clients & patients, slot availability, reminders
* Billing: invoices, items, taxes, payments
* Medical docs: findings, attachments, print/PDF
* Multi‑tenancy (SaaS)
* Role & permission model (per user / per location)
* Search, filters, exports, PDF prints

## Tech Stack

* **Laravel 12**, PHP 8.2+
* **Filament 4** (panels, resources, actions)
* **Flux UI v2** (modern UI components)
* **Laravel Herd** (local development)
* MySQL/MariaDB, Redis (cache/queue)
* Pest for tests
* Lucide icons (via Flux)

---

## Quick Start

### Prerequisites

* PHP 8.2+, Composer
* Node 20+, NPM
* **Laravel Herd** (recommended for local development)
* MySQL 8+ (or MariaDB 10.6+), Redis

### 1) Clone & install

```bash
git clone https://github.com/yourusername/vetlink.git
cd vetlink

composer install
cp .env.example .env
php artisan key:generate
```

### 2) Configure `.env`

```env
APP_NAME=VetLink
APP_ENV=local
APP_KEY=
APP_DEBUG=true
APP_URL=https://vetlink.test

APP_LOCALE=en
APP_FALLBACK_LOCALE=en
APP_FAKER_LOCALE=en_US

APP_MAINTENANCE_DRIVER=file
# APP_MAINTENANCE_STORE=database

# PHP_CLI_SERVER_WORKERS=4

BCRYPT_ROUNDS=12

LOG_CHANNEL=stack
LOG_STACK=single
LOG_DEPRECATIONS_CHANNEL=null
LOG_LEVEL=debug

DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=vetlink
DB_USERNAME=root
DB_PASSWORD=

SESSION_DRIVER=database
SESSION_LIFETIME=120
SESSION_ENCRYPT=false
SESSION_PATH=/
SESSION_DOMAIN=null

BROADCAST_CONNECTION=log
FILESYSTEM_DISK=local
QUEUE_CONNECTION=database

CACHE_STORE=database
# CACHE_PREFIX=

MEMCACHED_HOST=127.0.0.1

REDIS_CLIENT=phpredis
REDIS_HOST=127.0.0.1
REDIS_PASSWORD=null
REDIS_PORT=6379

MAIL_MAILER=log
MAIL_SCHEME=null
MAIL_HOST=127.0.0.1
MAIL_PORT=2525
MAIL_USERNAME=null
MAIL_PASSWORD=null
MAIL_FROM_ADDRESS="hello@vetlink.com"
MAIL_FROM_NAME="${APP_NAME}"

AWS_ACCESS_KEY_ID=
AWS_SECRET_ACCESS_KEY=
AWS_DEFAULT_REGION=us-east-1
AWS_BUCKET=
AWS_USE_PATH_STYLE_ENDPOINT=false

VITE_APP_NAME="${APP_NAME}"


```

### 3) Database & storage

```bash
php artisan migrate --seed
php artisan storage:link
```

### 4) Assets & dev server

```bash
npm install
npm run build
```

### 5) Run app with Laravel Herd

**Using Laravel Herd (Recommended):**

1. Ensure Laravel Herd is installed and running
2. Park the project directory in Herd or link it directly
3. Create subdomain `org1.vetlink.test` in Herd
4. Navigate to https://org1.vetlink.test/app/login
5. Login with email `admin@org1.com` and password `password`

**Note:** No need to start a server manually when using Herd.

---

### 6) Login to admin panel

1. Navigate to https://org1.vetlink.test/admin/login
2. Login with email `admin@admin.com` and password `admin`

### 7) Login to portal
1. Navigate to https://org1.vetlink.test/portal/login
2. Find `client email` from database for email and for password use `portal`

### 8) Import Lucide icons (optional)

To use additional icons beyond Heroicons:

```bash
php artisan flux:icon
# Or specify icons directly:
php artisan flux:icon crown grip-vertical github
```

**Note:** Filament only supports Heroicons, but Flux UI components can use Lucide icons.

## Contributing

1. Fork & create a feature branch
2. Run tests and static analysis
3. Open a PR with a clear description & screenshots (if UI)

Code style: `vendor/bin/pint` · Static analysis: `vendor/bin/phpstan analyse`
