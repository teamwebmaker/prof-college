# GEMINI.md

## Project Overview

This project is a web application for a professional college, built with the Laravel framework (version 10). It appears to be a comprehensive management system with both a public-facing website and an administrative panel. The application is multilingual, supporting Georgian ('ka') and English ('en'). The frontend is built using Vite.

### Key Technologies:

-   **Backend:** PHP 8.1, Laravel 10
-   **Frontend:** Vite, JavaScript
-   **Database:** (not explicitly specified, but likely MySQL or another relational database supported by Laravel)
-   **Web Server:** (not specified, but likely Apache or Nginx)

### Architecture:

The application follows a standard Model-View-Controller (MVC) architecture, which is characteristic of the Laravel framework.

-   **Models:** Located in `app/Models`, these define the database schema and relationships.
-   **Views:** Located in `resources/views`, these are the templates for the application's UI.
-   **Controllers:** Located in `app/Http/Controllers`, these handle user requests and interact with models and views.
-   **Routes:** Defined in `routes/web.php`, these map URLs to controller actions.

## Building and Running

### Backend:

-   **Dependencies:** Install PHP dependencies with `composer install`.
-   **Environment:** Create a `.env` file from `.env.example` and configure the database and other settings.
-   **Key Generation:** Generate an application key with `php artisan key:generate`.
-   **Migrations:** Run database migrations with `php artisan migrate`.
-   **Serving:** Run the development server with `php artisan serve`.

### Frontend:

-   **Dependencies:** Install JavaScript dependencies with `npm install`.
-   **Development:** Run the Vite development server with `npm run dev`.
-   **Building:** Build the frontend assets for production with `npm run build`.

## Development Conventions

-   **Routing:** Routes are defined in `routes/web.php` and are grouped by language (`/ka` or `/en`). Admin routes are prefixed with `/admin`.
-   **Controllers:** Resource controllers are used for CRUD operations.
-   **Models:** Models are located in `app/Models` and use Eloquent ORM.
-   **Views:** Blade templating engine is used for views.
-   **Styling:** (not explicitly specified, but likely CSS or a preprocessor like Sass/Less).
-   **Testing:** PHPUnit is used for testing. Run tests with `phpunit`.

## Directory Overview

The directory contains a standard Laravel project structure.

-   `app`: Contains the core application code, including models, controllers, and providers.
-   `config`: Contains the application's configuration files.
-   `database`: Contains database migrations, seeders, and factories.
-   `public`: The web server's document root. Contains the `index.php` entry point and publicly accessible assets.
-   `resources`: Contains frontend assets (CSS, JS) and views.
-   `routes`: Contains the application's route definitions.
-   `storage`: Contains logs, file uploads, and other generated files.
-   `tests`: Contains the application's tests.
-   `vendor`: Contains the project's Composer dependencies.

## Key Files

-   `composer.json`: Defines the project's PHP dependencies.
-   `package.json`: Defines the project's JavaScript dependencies.
-   `.env`: The environment configuration file (should be created from `.env.example`).
-   `routes/web.php`: Defines the application's web routes.
-   `app/Providers/RouteServiceProvider.php`: The main service provider for the application.
-   `config/app.php`: The main application configuration file.
-   `artisan`: The command-line interface for Laravel.

## Usage

This directory contains a complete web application. To use it, you will need to set up a local development environment with PHP, Composer, and Node.js. Follow the steps in the "Building and Running" section to get the application running.
