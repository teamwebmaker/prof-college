# Professional College System - Coding Standards & Comment Guidelines

## Overview
This document establishes coding standards and comment guidelines for the Professional College Laravel application. Following these standards ensures code consistency, maintainability, and ease of collaboration across the development team.

## Comment-Based Development Approach

### Philosophy
Our codebase follows a **comment-first development** approach where:
- Every class, method, and significant code block is thoroughly documented
- Business logic is explained through comments before implementation
- TODO items track future improvements and technical debt
- FIXME comments identify known issues requiring attention

### Comment Types

#### 1. Class-Level Documentation
```php
/**
 * ArticleController manages news articles and blog posts for the professional college
 * 
 * This controller handles the complete lifecycle of articles including:
 * - Article creation with multilingual support (Georgian/English)
 * - Image upload and management
 * - Embedding external content (videos, social media)
 * - Category assignment and organization
 * - UUID-based unique identification for SEO-friendly URLs
 * 
 * Business Logic:
 * - All articles must have both Georgian and English content
 * - Articles can be categorized for better organization
 * - Optional embed functionality for rich media content
 * - Image uploads are stored in public/images/articles/
 * - UUID ensures unique, shareable article URLs
 * 
 * @author Professional College Development Team
 * @version 1.2
 * @since 2024-02-07
 */
class ArticleController extends Controller
```

#### 2. Method Documentation
```php
/**
 * Store a newly created article with multilingual support and media handling
 * 
 * Processing Pipeline:
 * 1. Validate incoming data using StoreArticleRequest
 * 2. Handle optional image upload with unique naming
 * 3. Structure multilingual content for JSON storage
 * 4. Generate UUID for SEO-friendly URLs
 * 5. Create article record with optional embed content
 * 6. Redirect with localized success message
 * 
 * Image Upload Logic:
 * - Generates unique filename: uniqid() + timestamp + extension
 * - Stores in public/images/articles/ directory
 * - Supports standard web formats (jpg, png, gif, webp)
 * 
 * UUID Generation:
 * - Creates unique identifier for each article
 * - Used in public URLs for better SEO and sharing
 * - Prevents ID enumeration attacks
 * 
 * @param StoreArticleRequest $request Validated article creation data
 * @return \Illuminate\Http\RedirectResponse Redirect to articles index
 * @throws \Illuminate\Contracts\Filesystem\FileNotFoundException If upload fails
 */
public function store(StoreArticleRequest $request)
```

#### 3. Inline Comments for Business Logic
```php
// Handle image upload with error checking
$imageName = null;
if ($request->hasFile('image')) {
    $image = $request->file('image');
    // Generate collision-resistant filename
    $imageName = uniqid() . '-' . time() . '.' . $image->getClientOriginalExtension();
    $uploadPath = 'images/articles';

    // TODO: Add image validation (dimensions, file size)
    // TODO: Implement image optimization/resizing
    // TODO: Add thumbnail generation for listing pages
    $image->move(public_path($uploadPath), $imageName);
}
```

#### 4. TODO Comments for Future Improvements
```php
// TODO: Add filtering by subject or search functionality
// TODO: Consider adding sorting options (name, subject, date)
return view('admin.teachers.index', [
    'teachers' => Teacher::orderBy('id', 'DESC')->paginate(10)
]);
```

#### 5. FIXME Comments for Known Issues
```php
$storeData = [
    'title' => $title,
    'description' => $description,
    'category_id' => $data['category_id'],
    // FIXME: Regenerating UUID on update breaks existing article URLs
    // Consider removing this line to preserve article links
    'uuid' => Str::uuid()->toString()
];
```

## Laravel-Specific Standards

### Controller Standards
```php
namespace App\Http\Controllers;

use App\Models\Article;
use App\Http\Requests\StoreArticleRequest;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;

/**
 * Controller class documentation here
 */
class ArticleController extends Controller
{
    /**
     * Method documentation with full PHPDoc
     */
    public function index(): View
    {
        // Implementation with inline comments
        return view('admin.articles.index', [
            'articles' => Article::orderBy('id', 'DESC')->paginate(6),
        ]);
    }
}
```

### Model Standards
```php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * Article Model - Represents news articles and blog posts
 * 
 * Detailed model documentation including:
 * - Business rules
 * - Database structure
 * - Relationships
 * - Usage examples
 * 
 * @property int $id Primary key
 * @property array $title Multilingual article title
 * @property string $uuid Unique identifier
 */
class Article extends Model
{
    /**
     * The attributes that are mass assignable.
     * 
     * Security Note: Explanation of why fields are fillable
     *
     * @var array<string>
     */
    protected $fillable = [
        'title',        // Multilingual JSON
        'description',  // Multilingual JSON
        'image',        // Image filename
        'uuid',         // Unique identifier
        'embed',        // Optional embedded content
        'category_id'   // Foreign key
    ];
}
```

### Route Documentation
```php
/**
 * Professional College Web Routes Configuration
 * 
 * Comprehensive route documentation including:
 * - Route structure explanation
 * - Security features
 * - Multilingual support
 * - Performance considerations
 * 
 * @author Professional College Development Team
 * @version 2.0
 */

// Default language redirect
Route::redirect('/', '/ka');

// Language-prefixed routes with detailed grouping
Route::group(['prefix' => '{language}'], function () {
    // Admin routes with middleware protection
    Route::prefix('admin')->group(function () {
        // Authentication routes
        Route::get('/', [AdminController::class, 'login'])->name('admin.login.page');
        
        // Protected admin dashboard routes
        Route::middleware(['route.guard'])->group(function () {
            // Resource controllers with specific limitations
            Route::resource('/articles', ArticleController::class)->except('show');
        });
    });
});
```

## Multilingual System Documentation

### JSON Casting Pattern
```php
/**
 * Custom JSON casting for multilingual content
 * 
 * Allows seamless access to translations:
 * - $model->title['ka'] for Georgian
 * - $model->title['en'] for English
 * 
 * Storage format: {"ka": "Georgian text", "en": "English text"}
 */
protected $casts = [
    'title' => JsonConvertCast::class,
    'description' => JsonConvertCast::class
];

// Usage in controllers
$title = ['ka' => $data['title_ka'], 'en' => $data['title_en']];
```

## Security Documentation Standards

### Authentication Comments
```php
// Security: Only accessible through admin routes with route.guard middleware
// No additional authorization checks beyond authentication required
public function destroy(string $language, Article $article): RedirectResponse
{
    // TODO: Add confirmation step to prevent accidental deletions
    // TODO: Log deletion action for security audit
    $article->delete();
}
```

### Input Validation Comments
```php
// Validate incoming request data
// TODO: Create dedicated StoreTeacherRequest for better validation
$data = $request->validate([
    'full_name_ka' => 'required|string|max:255',
    'full_name_en' => 'required|string|max:255', 
    'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048' // 2MB max
]);
```

## Performance Documentation

### Database Query Comments
```php
/**
 * Performance Optimizations:
 * - Eager loads related docs to prevent N+1 queries
 * - Could implement view counting for analytics
 * - Suitable for caching at reverse proxy level
 */
public function show(string $language, Article $article)
{
    // Eager load related documents to prevent N+1 query problem
    $article->load('docs');
    
    // TODO: Increment view counter for analytics
    // TODO: Load related articles from same category
    return view('pages.view-more', ['article' => $article]);
}
```

### Pagination Comments
```php
// Performance Notes:
// - Limited to 6 articles per page to optimize loading time
// - Uses DESC order to prioritize recent content
// - Consider adding search/filter functionality for large datasets
return view('admin.articles.index', [
    'articles' => Article::orderBy('id', 'DESC')->paginate(6),
]);
```

## Error Handling Documentation

### Exception Documentation
```php
/**
 * @throws \Illuminate\Contracts\Filesystem\FileNotFoundException If upload fails
 * @throws \Illuminate\Validation\ValidationException If validation fails
 */
public function store(StoreArticleRequest $request): RedirectResponse
{
    // Handle image upload with error checking
    if ($request->hasFile('image')) {
        // TODO: Add try-catch for file operation errors
        $image->move(public_path($uploadPath), $imageName);
    }
}
```

## Technical Debt Documentation

### Issue Tracking Comments
```php
// KNOWN ISSUES:
// 1. UUID regeneration on update breaks existing links
// 2. Image files not cleaned up (storage bloat)
// 3. Related records not handled (docs, comments if any)
public function update(UpdateArticleRequest $request, Article $article)
{
    // FIXME: Regenerating UUID on update breaks existing article URLs
    'uuid' => Str::uuid()->toString()
}
```

### Improvement Comments
```php
// TODO IMPROVEMENTS:
// - Implement soft deletes for data recovery
// - Add image cleanup on deletion/replacement
// - Create dedicated Form Request classes
// - Add search functionality to admin panels
// - Implement role-based access control
```

## File Organization Standards

### Controller Organization
```
app/Http/Controllers/
├── AdminController.php          # Authentication & dashboard
├── ArticleController.php        # News & blog management
├── TeacherController.php        # Staff profile management
├── PageController.php           # Public page display
└── [Resource]Controller.php     # Following RESTful naming
```

### Model Organization
```
app/Models/
├── Article.php                  # Content models
├── Teacher.php                  # People models
├── Category.php                 # Taxonomy models
└── [Entity].php                 # Domain-specific models
```

## Version Control Standards

### Commit Message Format
```
feat(articles): add comprehensive PHPDoc comments to ArticleController

- Added class-level documentation explaining business logic
- Documented all CRUD methods with parameter types and return values
- Added TODO comments for future improvements
- Fixed inconsistent success messages
- Added performance and security notes

Closes #123
```

### Branch Naming
```
feature/comprehensive-documentation
bugfix/uuid-regeneration-issue
refactor/teacher-controller-implementation
docs/coding-standards-guide
```

## Code Review Checklist

### Documentation Review
- [ ] All public methods have PHPDoc comments
- [ ] Business logic is explained through comments
- [ ] TODO items are tracked and prioritized
- [ ] Security considerations are documented
- [ ] Performance implications are noted

### Code Quality Review
- [ ] PSR-4 naming conventions followed
- [ ] Type hints used for parameters and returns
- [ ] Validation handled appropriately
- [ ] Error cases documented and handled
- [ ] Database queries optimized

---

**Note**: This document should be regularly updated as coding standards evolve and new patterns are established in the codebase.
