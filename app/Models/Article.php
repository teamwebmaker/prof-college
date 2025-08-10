<?php

namespace App\Models;

use App\Casts\JsonConvertCast;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * Article Model - Represents news articles and blog posts in the professional college system
 * 
 * This model manages multilingual article content with support for:
 * - Georgian and English translations stored as JSON
 * - Featured image handling for visual content
 * - Category-based organization and filtering
 * - UUID-based unique identification for SEO-friendly URLs
 * - Optional embedded content (videos, social media, etc.)
 * - Related document attachments
 * 
 * Database Structure:
 * - id: Primary key (auto-increment)
 * - title: JSON field containing {"ka": "Georgian title", "en": "English title"}
 * - description: JSON field containing multilingual descriptions
 * - image: Filename of uploaded featured image (stored in public/images/articles/)
 * - uuid: Unique identifier for public URLs and sharing
 * - embed: Optional HTML/iframe code for embedded content
 * - category_id: Foreign key to categories table for article organization
 * - created_at/updated_at: Laravel timestamps
 * 
 * Business Rules:
 * - All articles must have both Georgian and English content
 * - Images are optional but recommended for better engagement
 * - UUID must be unique across all articles
 * - Category assignment is required for proper organization
 * - Embed content is sanitized in the frontend (security consideration)
 * 
 * @property int $id Primary key
 * @property array $title Multilingual article title (ka/en)
 * @property array $description Multilingual article description (ka/en)
 * @property string|null $image Featured image filename
 * @property string $uuid Unique identifier for public URLs
 * @property string|null $embed Optional embedded content HTML/iframe
 * @property int $category_id Foreign key to categories
 * @property \Carbon\Carbon $created_at Creation timestamp
 * @property \Carbon\Carbon $updated_at Last update timestamp
 * 
 * @property-read \App\Models\Category $category Related category
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Doc[] $docs Related documents
 * 
 * @author Professional College Development Team
 * @version 1.3
 * @since 2024-02-07
 * @package App\Models
 */
class Article extends Model
{
    use HasFactory;
    
    /**
     * The attributes that are mass assignable.
     * 
     * Security Note: All fields are fillable as this model is only accessed
     * through admin interface with proper authentication and validation.
     *
     * @var array<string>
     */
    protected $fillable = [
        'title',        // Multilingual JSON: {"ka": "Georgian", "en": "English"}
        'description',  // Multilingual JSON: {"ka": "Georgian", "en": "English"}
        'image',        // Image filename (stored in public/images/articles/)
        'uuid',         // Unique identifier for SEO-friendly URLs
        'embed',        // Optional embedded content (HTML/iframe)
        'category_id'   // Foreign key to categories table
    ];
    
    /**
     * The attributes that should be cast to specific types.
     * 
     * Uses custom JsonConvertCast to handle multilingual JSON fields.
     * This allows easy access like: $article->title['ka'] or $article->title['en']
     *
     * @var array<string, string>
     * @see \App\Casts\JsonConvertCast For JSON casting implementation
     */
    protected $casts = [
        'title' => JsonConvertCast::class,        // JSON casting for multilingual title
        'description' => JsonConvertCast::class   // JSON casting for multilingual description
    ];

    /**
     * Get all documents associated with this article
     * 
     * Relationship allows articles to have multiple supporting documents,
     * PDFs, attachments, or related files that provide additional information.
     * 
     * Usage Examples:
     * - $article->docs - Get all related documents
     * - $article->docs()->where('type', 'pdf')->get() - Filter by document type
     * - $article->load('docs') - Eager load to prevent N+1 queries
     * 
     * @return HasMany<\App\Models\Doc> Relationship to Doc model
     * @see \App\Models\Doc For document model details
     */
    public function docs(): HasMany
    {
        return $this->hasMany(Doc::class);
    }

    /**
     * Get the category this article belongs to
     * 
     * Every article must be assigned to a category for proper organization
     * and navigation. Categories help users find related content and provide
     * structure for the website's information architecture.
     * 
     * Usage Examples:
     * - $article->category - Get the related category
     * - $article->category->name - Get category name
     * - Article::with('category')->get() - Eager load categories
     * 
     * @return BelongsTo<\App\Models\Category, \App\Models\Article> Relationship to Category model
     * @see \App\Models\Category For category model details
     */
    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }
    
    // TODO: Add scope methods for common queries
    // public function scopePublished($query) - for published articles only
    // public function scopeByCategory($query, $categoryId) - filter by category
    // public function scopeRecent($query, $days = 30) - recent articles
    
    // TODO: Add accessor methods for better data presentation
    // public function getImageUrlAttribute() - get full image URL
    // public function getExcerptAttribute($length = 150) - get article excerpt
    // public function getPublicUrlAttribute() - get public article URL using UUID
    
    // TODO: Consider adding search functionality
    // public function scopeSearch($query, $term) - search in titles and descriptions
    
    // TODO: Add validation methods
    // public function validateImageExists() - check if image file actually exists
    // public function validateEmbedCode() - sanitize and validate embed content
}
