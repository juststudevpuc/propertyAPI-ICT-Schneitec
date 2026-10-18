# cms-propT

A Laravel-based property CMS for managing property listings, company projects, published news, guest feedback, and booking inquiries.

## Overview

`cms-propT` is a content management system built with Laravel 12 and designed for property-focused websites. It provides:

- Property catalog management with publish/status controls
- Project showcase management
- News and article publishing
- Media asset storage and upload management
- Guest feedback collection
- Booking inquiry submissions
- Admin authentication with Laravel Sanctum
- Cloudinary media support for image hosting

## Tech Stack

- PHP 8.2
- Laravel 12
- SQLite by default for local development
- Vite + Tailwind CSS for frontend asset compilation
- Laravel Sanctum for admin API authentication
- Cloudinary integration for media uploads

## Features

### Public API

The public API serves marketing and listing content without authentication:

- `GET /api/v1/properties`
- `GET /api/v1/properties/{id}`
- `GET /api/v1/projects`
- `GET /api/v1/projects/{id}`
- `GET /api/v1/news`
- `GET /api/v1/news/{id}`
- `POST /api/v1/feedback`
- `POST /api/v1/inquiries/booking`

### Admin API

Protected admin endpoints require a Sanctum token:

- `POST /api/v1/admin/login`
- `GET /api/v1/admin/me`
- `POST /api/v1/admin/logout`
- CRUD endpoints for properties, projects, and news
- `GET /api/v1/admin/media`
- `POST /api/v1/admin/media/upload`
- `PUT /api/v1/admin/media/{mediaAsset}`
- `DELETE /api/v1/admin/media/{mediaAsset}`
- `GET /api/v1/admin/inbox/inquiries`
- `GET /api/v1/admin/inbox/feedback`

## Quick Start

### 1. Install dependencies

```bash
composer install
npm install
```

### 2. Configure environment

```bash
cp .env.example .env
php artisan key:generate
```

If you are using the default local setup, SQLite is already configured in `.env.example`.

### 3. Run database migrations

```bash
php artisan migrate
```

### 4. Start the app

For local development:

```bash
php artisan serve
npm run dev
```

Alternatively, the project includes a setup script:

```bash
composer run setup
```

## Environment Variables

Optional provider configuration for media uploads:

```env
CLOUDINARY_CLOUD_NAME=your-cloud-name
CLOUDINARY_API_KEY=your-api-key
CLOUDINARY_API_SECRET=your-api-secret
CLOUDINARY_FOLDER=cms-propT
```

## Project Structure

```text
app/                Laravel application code
config/             Configuration files
database/           Migrations and seeders
public/             Public entry point
resources/          Frontend assets and views
routes/             API and web routes
storage/            Cached and generated files
tests/              Automated tests
```

## Development Notes

- Admin authentication uses Laravel Sanctum.
- Media assets are integrated with Cloudinary for asset hosting.
- The app is structured around REST-style API endpoints for CMS operations.
- Default local database setup is SQLite, making it easy to work in a local development environment.

## License

This project is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).
