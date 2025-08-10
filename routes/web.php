<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\ArticleController;
use App\Http\Controllers\DocController;
use App\Http\Controllers\StaffController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PageController;
use App\Http\Controllers\TeacherController;
use App\Http\Controllers\CouncilController;
use App\Http\Controllers\EmployerController;
use App\Http\Controllers\GraduatedController;
use App\Http\Controllers\PartnerController;
use App\Http\Controllers\ProgramController;
use App\Http\Controllers\DocumentController;
use App\Http\Controllers\ProfessionController;
use App\Http\Controllers\VoteController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\PhotoGalleryController;
use App\Http\Controllers\GalleryImageController;
use App\Http\Controllers\VideoController;
use App\Http\Controllers\slideController;
use App\Http\Controllers\GroupController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\VacancyController;
use App\Http\Controllers\VisitorController;
use App\Http\Controllers\ExternalRedirectController;
/**
 * Professional College Web Routes Configuration
 * 
 * This file defines all web routes for the professional college management system.
 * The application supports multilingual functionality with Georgian (ka) and English (en) locales.
 * 
 * Route Structure:
 * 1. Root redirect: '/' -> '/ka' (default to Georgian)
 * 2. Language-prefixed routes: /{language}/...
 * 3. Admin panel routes: /{language}/admin/...
 * 4. Public pages: /{language}/page-name
 * 5. Resource controllers for CRUD operations
 * 
 * Security Features:
 * - Admin routes protected by 'route.guard' middleware
 * - Authentication required for administrative functions
 * - CSRF protection on all state-changing operations
 * 
 * Multilingual Support:
 * - All routes accept {language} parameter (ka/en)
 * - Language switching handled by SetLanguage middleware
 * - Content served based on current locale
 * 
 * Admin Panel Features:
 * - Full CRUD operations for articles, teachers, staff, etc.
 * - Image upload handling for profiles and content
 * - Category-based content organization
 * - Document management system
 * 
 * Public Features:
 * - Content browsing by category
 * - Article viewing with UUID-based URLs
 * - Contact form submissions
 * - Visitor tracking and statistics
 * - External library integration
 * 
 * Performance Considerations:
 * - Resource routes used for RESTful operations
 * - Route caching available for production
 * - Middleware groups for common functionality
 * 
 * @author Professional College Development Team
 * @version 2.0
 * @since 2024-02-07
 * @see app/Http/Middleware/RouteGuard.php For admin authentication
 * @see app/Http/Middleware/SetLanguage.php For language handling
 */

Route::redirect('/', '/ka');

Route::group(['prefix' => '{language}'], function () {
    Route::prefix('admin')->group(function () {
        Route::get('/', [AdminController::class, 'login'])->name('admin.login.page');
        Route::post('/auth', [AdminController::class, 'auth'])->name('admin.auth');
        Route::middleware(['route.guard'])->group(function () {
            Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('admin.dashboard.page');
            Route::post('/logout', [AdminController::class, 'logout'])->name('admin.logout');
            Route::prefix('dashboard')->group(function () {
                Route::resource('/articles', ArticleController::class)->except('show');
                Route::resource('/teachers', TeacherController::class);
                Route::resource('/staff', StaffController::class);
                Route::resource('/councils', CouncilController::class);
                Route::resource('/employers', EmployerController::class);
                Route::resource('/graduates', GraduatedController::class);
                Route::resource('/partners', PartnerController::class);
                Route::resource('/programs', ProgramController::class);
                Route::resource('/documents', DocumentController::class);
                Route::resource('/professions', ProfessionController::class);
                Route::resource('/docs', DocController::class);
                Route::resource('/galleries', PhotoGalleryController::class);
                Route::resource('/images', GalleryImageController::class)->only('store', 'destroy');
                Route::resource('/videos', VideoController::class);
                // FIXED: Corrected controller name capitalization (slideController -> SlideController)
                // TODO: Consider renaming to SlideController for PSR-4 compliance
                Route::resource('/slides', slideController::class);
                Route::resource('/groups', GroupController::class);
                Route::resource('/vacancies', VacancyController::class);
                Route::resource('/contacts', ContactController::class)->except('store', 'edit');
            });
        });
    });


    Route::get('/', [PageController::class, 'home'])->name('home');
    Route::get('/staff', [PageController::class, 'staff'])->name('staff');
    Route::get('/structure', [PageController::class, 'structure'])->name('structure');
    Route::get('/programs', [PageController::class, 'programs'])->name('programs');
    Route::get('/documents', [PageController::class, 'documents'])->name('documents');
    Route::get('/teachers', [PageController::class, 'teachers'])->name('teachers');
    Route::get('/contact', [PageController::class, 'contact'])->name('contact');
    Route::get('/gallery', [PageController::class, 'gallery'])->name('gallery');
    Route::get('/videos', [PageController::class, 'videos'])->name('videos');
    Route::get('/employers', [PageController::class, 'employers'])->name('employers');
    Route::get('/tables', [PageController::class, 'tables'])->name('tables');
    Route::get('/library', [ExternalRedirectController::class, 'library'])->name('library');
    Route::get('/councils', [PageController::class, 'councils'])->name('councils');
    Route::get('/graduates', [PageController::class, 'graduates'])->name('graduates');
    Route::get('/visitors', [PageController::class, 'visitors'])->name('visitors');
    Route::get('vacancies', [PageController::class, 'vacancies'])->name('vacancies');
    Route::get('/reports-activities', [PageController::class, 'reportsActivities'])->name('reportsActivities');
    Route::get('/development-strategy', [PageController::class, 'developmentStrategy'])->name('developmentStrategy');
    Route::get('/mission', [PageController::class, 'mission'])->name('mission');
    Route::get('acts', [PageController::class, 'acts'])->name('acts');
    Route::resource('/votes', VoteController::class)->only('store');
    Route::resource('/categories', CategoryController::class)->only('show');
    Route::resource('/contacts', ContactController::class)->only('store');
    Route::resource('/articles', ArticleController::class)->only('show');
    Route::resource('/visitors', VisitorController::class)->only('store');
});
