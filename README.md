# Laravel Skeleton

A modern, feature-rich Laravel 13 skeleton application with authentication, real-time interactivity, and comprehensive
development tooling.

<p align="center">
  <a href="https://laravel.com/docs" target="_blank"><img src="https://img.shields.io/badge/Laravel-13.8-FF2D20?logo=laravel&logoColor=white" alt="Laravel 13.8"></a>
  <a href="https://php.net" target="_blank"><img src="https://img.shields.io/badge/PHP-%5E8.3-777BB4?logo=php&logoColor=white" alt="PHP ^8.3"></a>
  <a href="LICENSE" target="_blank"><img src="https://img.shields.io/badge/License-MIT-green" alt="License"></a>
</p>

Check out my Laravel packages:

- **[Laravel Blacklist](https://packagist.org/packages/milenmk/laravel-blacklist)** - A Laravel package for blacklist
  validation of user input
- **[Laravel Email Change Confirmation](https://packagist.org/packages/milenmk/laravel-email-change-confirmation)** -
  Secure email change confirmation system
- **[Laravel Locations](https://packagist.org/packages/milenmk/laravel-locations)** - Add Countries, Cities, Areas,
  Languages and Currencies models to your Laravel application
- **[Laravel Route Label](https://packagist.org/packages/milenmk/laravel-route-label)** - Add label support to Laravel
  routes with routeLabel() helper and Blade @routeLink directive
- **[Laravel GDPR Exporter](https://packagist.org/packages/milenmk/laravel-gdpr-exporter)** - GDPR-compliant data export
  functionality
- **[Laravel Rate Limiting](https://packagist.org/packages/milenmk/laravel-rate-limiting)** - Advanced rate limiting
  capabilities with exponential backoff
- **[Laravel Datatables and Forms](https://packagist.org/packages/milenmk/laravel-simple-datatables-and-forms)** - Easy
  to use package to create datatables and forms for Livewire components

## 📋 Table of Contents

- [Features](#features)
- [Requirements](#requirements)
- [Installation](#installation)
- [Configuration](#configuration)
- [Project Structure](#project-structure)
- [Development](#development)
- [Testing & Quality](#testing--quality)
- [Authentication](#authentication)
- [Customization](#customization)
- [Contributing](#contributing)
- [License](#license)

## ✨ Features

### Authentication & Security

- **Laravel Fortify** - Powerful authentication scaffolding
- **Two-Factor Authentication** - Enhanced security with 2FA support
- **Passkey Support** - Modern WebAuthn authentication
- **Email Change Confirmation** - Secure email update workflow
- **Route Labeling** - Named route management
- **Blacklist Protection** - Email/IP blacklist capabilities

### Frontend & UI

- **Livewire 4** - Full-stack reactive Laravel components
- **Tailwind CSS 4** - Modern utility-first CSS framework
- **Blade Icons** - Comprehensive icon system
- **Vite** - Next-generation frontend build tool
- **Responsive Design** - Mobile-first, production-ready UI

### Development Experience

- **Laravel Tinker** - Interactive REPL for Laravel
- **Laravel Debugbar** - Powerful debugging toolkit
- **Concurrent Development** - Run multiple services simultaneously (server, queue, Vite)

### Code Quality & Testing

#### Static Analysis

- **PHPStan** - Advanced PHP static analysis (Level 9)
- **Rector** - Automated code modernization
- **Pint** - Laravel code style fixer
- **Duster** - Comprehensive style checking

#### Testing

- **PHPUnit 12** - Powerful PHP testing framework
- **Paratest** - Parallel test execution for faster CI/CD
- **Mockery** - Mocking library for tests
- **Faker** - Realistic testing data generation

#### Frontend Quality

- **Prettier** - Code formatter for JS, CSS, and Blade templates
- **Stylelint** - CSS linting and formatting
- **Husky** - Git hooks management
- **Lint-staged** - Run linters on staged files

## 📦 Requirements

- **PHP** `^8.3`
- **Node.js** `>=18.x`
- **Composer** (latest)
- **SQLite/PostgreSQL/MySQL** (database)

## 🚀 Installation

### 1. Clone the Repository

```bash
git clone https://github.com/your-org/laravel-skeleton.git
cd laravel-skeleton
```

### 2. Install Dependencies

```bash
# Install PHP dependencies
composer install

# Install Node.js dependencies
npm install
```

### 3. Environment Configuration

```bash
# Copy environment file
cp .env.example .env

# Generate application key
php artisan key:generate

# Create SQLite database (if using SQLite)
touch database/database.sqlite
```

### 4. Database Setup

```bash
# Run migrations
php artisan migrate

# (Optional) Seed database with sample data
php artisan db:seed
```

### 5. Build Assets

```bash
# Development build with hot reload
npm run dev

# Production build
npm run build
```

## ⚙️ Configuration

### Key Configuration Files

- **`config/fortify.php`** - Authentication features and settings
- **`config/auth.php`** - Guards and password brokers
- **`config/email-change-confirmation.php`** - Email change workflow
- **`config/blacklist.php`** - Blacklist configuration
- **`config/livewire.php`** - Livewire settings
- **`.env`** - Environment variables

### Environment Variables

```env
# Application
APP_NAME="Laravel Skeleton"
APP_ENV=local
APP_DEBUG=true
APP_KEY=base64:...
APP_URL=http://localhost:8000

# Database
DB_CONNECTION=sqlite
DB_DATABASE=database/database.sqlite

# Mail
MAIL_MAILER=log
MAIL_FROM_ADDRESS=hello@example.com
MAIL_FROM_NAME="${APP_NAME}"

# Queue
QUEUE_CONNECTION=database

# Session/Cache
SESSION_DRIVER=database
CACHE_DRIVER=database
```

## 📁 Project Structure

```
laravel-skeleton/
├── app/
│   ├── Actions/               # Action classes (Fortify actions)
│   ├── Http/
│   │   └── Controllers/       # HTTP controllers
│   ├── Models/                # Eloquent models
│   ├── Providers/             # Service providers
│   ├── View/
│   │   └── Components/        # Livewire & Blade components
│   └── helpers.php            # Global helper functions
├── bootstrap/                 # Bootstrap files
├── config/                    # Configuration files
├── database/
│   ├── factories/             # Model factories for testing
│   ├── migrations/            # Database migrations
│   └── seeders/               # Database seeders
├── public/                    # Public assets (compiled)
├── resources/
│   ├── css/                   # Tailwind CSS files
│   ├── js/                    # JavaScript files
│   ├── views/                 # Blade templates
│   └── svg/                   # SVG assets
├── routes/
│   ├── console.php            # Console commands
│   └── web.php                # Web routes
├── storage/                   # Logs, cache, uploads
├── tests/
│   ├── Feature/               # Feature tests
│   └── Unit/                  # Unit tests
├── composer.json              # PHP dependencies
├── package.json               # Node.js dependencies
└── vite.config.js             # Vite configuration
```

## 🛠️ Development

### Start Development Server

```bash
# Run all services (server, queue, Vite)
composer run dev

# Or run individually:

# Start Laravel development server (http://localhost:8000)
php artisan serve

# Start queue listener
php artisan queue:listen --tries=1

# Start Vite dev server
npm run dev
```

### Useful Artisan Commands

```bash
# Check application status
php artisan status

# Interactive shell
php artisan tinker

# View logs in real-time
php artisan pail

# Create a new migration
php artisan make:migration create_posts_table

# Create a model with migration
php artisan make:model Post -m

# Create a Livewire component
php artisan livewire:create ComponentName

# Clear all caches
php artisan cache:clear && php artisan view:clear && php artisan route:clear
```

## 🧪 Testing & Quality Assurance

### Run Tests

```bash
# Run full test suite
php artisan test

# Run tests in parallel
php artisan test --parallel

# Run specific test file
php artisan test tests/Feature/AuthTest.php

# Run with coverage
php artisan test --coverage

# Run only unit tests
php artisan test tests/Unit

# Run only feature tests
php artisan test tests/Feature
```

### Code Quality & Formatting

```bash
# Run all quality checks
composer run test

# Format and fix code
composer run fix

# Only check types (PHPStan)
composer run test:types

# Modernize code with Rector
composer run test:refactor

# Format code with Pint
composer run pint

# Format frontend files
composer run prettier

# Fix style issues with Duster
./vendor/bin/duster fix

# Check for typos
composer run test:typos

# Generate PHPStan baseline
composer run phpstan-baseline
```

### CI/CD Example

```bash
# Pre-commit hook (runs automatically)
git add .
git commit -m "Your message"  # Runs lint-staged

# Manual quality check before push
composer run test && composer run fix
```

## 🔐 Authentication

### Features

- **Email/Password Login** - Standard authentication
- **Email Verification** - Confirm email addresses
- **Two-Factor Authentication** - SMS or authenticator app
- **Passkeys** - WebAuthn passwordless authentication
- **Remember Me** - Persistent login sessions
- **Password Reset** - Secure password recovery
- **Email Change Confirmation** - Verify new email addresses

### Custom Actions

Place custom authentication actions in `app/Actions/Fortify/`:

```php
// Example: Custom login action
namespace App\Actions\Fortify;

class CustomLoginAction
{
    public function __invoke(User $user)
    {
        // Custom logic
    }
}
```

## 🎨 Customization

### Adding New Pages

1. **Create a Route** (`routes/web.php`)

```php
Route::get('/dashboard', DashboardController::class)->middleware('auth');
```

2. **Create a Controller** or **Livewire Component**

```bash
php artisan make:controller DashboardController
php artisan livewire:create Dashboard
```

3. **Create a View** (`resources/views/dashboard.blade.php`)

### Custom API Endpoints

Add routes to `routes/web.php` or create a dedicated `routes/api.php`:

```php
Route::middleware('api')->prefix('api')->group(function () {
    Route::get('/user', UserController::class);
});
```

### Database Customization

1. Create a migration
2. Modify in `app/Models/User.php` or create new models
3. Update factories in `database/factories/`
4. Update seeders in `database/seeders/`

## 🤝 Contributing

1. **Follow the code style** - Run `composer run prettier` before committing
2. **Add tests** - New features should include tests
3. **Update documentation** - Keep README and comments current
4. **Use Git hooks** - Husky and lint-staged are configured

### Pre-commit Checks

- ESLint and Prettier run automatically on staged files
- Run `git commit` to trigger checks

## 📜 License

This project is open-sourced software licensed under the [MIT license](LICENSE).

---

## 🔗 Useful Links

- [Laravel Documentation](https://laravel.com/docs)
- [Laravel Fortify](https://laravel.com/docs/fortify)
- [Livewire Documentation](https://livewire.laravel.com)
- [Tailwind CSS](https://tailwindcss.com)
- [Vite](https://vitejs.dev)
- [PHPStan](https://phpstan.org)
- [Rector](https://getrector.org)

## 📝 Notes for AI Agents

This Laravel skeleton is optimized for AI-assisted development:

- **Well-organized structure** - Clear separation of concerns
- **Type hints throughout** - Enables better IDE and AI assistance
- **Comprehensive tests** - Serve as documentation and examples
- **Configuration-driven** - Most settings can be configured without code changes
- **Modern tooling** - PHPStan, Rector, and Pint help maintain code quality

### Using with AI Assistants

AI coding agents like Claude, Cursor, and GitHub Copilot work best with Laravel when you:

1. Keep component responsibilities small and focused
2. Use type hints consistently
3. Write descriptive variable and function names
4. Add docblock comments for complex logic
5. Create tests alongside features

For **even better AI integration**, consider using [Laravel Boost](https://laravel.com/docs/ai), which provides AI tools
and skills for Laravel development.

---

**Last Updated:** May 2026
