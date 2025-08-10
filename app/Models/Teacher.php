<?php

namespace App\Models;

use App\Casts\JsonConvertCast;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * Teacher Model - Represents teaching staff profiles in the professional college system
 * 
 * This model manages teacher information with multilingual support for:
 * - Full names in both Georgian and English
 * - Subject specializations and teaching areas
 * - Professional profile photographs
 * - Academic credentials and experience (future enhancement)
 * 
 * Database Structure:
 * - id: Primary key (auto-increment)
 * - full_name: JSON field containing {"ka": "Georgian name", "en": "English name"}
 * - subject: JSON field containing {"ka": "Georgian subject", "en": "English subject"}
 * - image: Profile photo filename (stored in public/images/teachers/)
 * - created_at/updated_at: Laravel timestamps
 * 
 * Business Rules:
 * - All teachers must have names in both Georgian and English
 * - Subject information is required for proper categorization
 * - Profile images are recommended but not mandatory
 * - Teacher profiles are publicly visible on the website
 * - Multiple subjects can be listed in the subject field
 * 
 * Potential Enhancements:
 * - Academic degrees and certifications
 * - Years of experience tracking
 * - Course assignments and schedules
 * - Student feedback and ratings
 * - Research publications and achievements
 * - Contact information (email, phone)
 * 
 * @property int $id Primary key
 * @property array $full_name Multilingual teacher name (ka/en)
 * @property array $subject Multilingual subject specialization (ka/en)
 * @property string|null $image Profile photo filename
 * @property \Carbon\Carbon $created_at Creation timestamp
 * @property \Carbon\Carbon $updated_at Last update timestamp
 * 
 * @author Professional College Development Team
 * @version 1.1
 * @since 2024-02-07
 * @package App\Models
 * 
 * @todo Add relationship to courses or programs taught
 * @todo Implement teacher availability scheduling
 * @todo Add academic qualification fields
 * @todo Consider soft deletes for historical data preservation
 */
class Teacher extends Model
{
    use HasFactory;
    
    /**
     * The attributes that are mass assignable.
     * 
     * All teacher fields are fillable as this model is accessed only through
     * authenticated admin interface with proper validation.
     *
     * @var array<string>
     */
    protected $fillable = [
        'full_name',    // Multilingual JSON: {"ka": "Georgian name", "en": "English name"}
        'subject',      // Multilingual JSON: {"ka": "Georgian subject", "en": "English subject"}
        'image'         // Profile photo filename (stored in public/images/teachers/)
    ];
    
    /**
     * The attributes that should be cast to specific types.
     * 
     * Uses custom JsonConvertCast for seamless multilingual data handling.
     * Allows easy access: $teacher->full_name['ka'] or $teacher->subject['en']
     *
     * @var array<string, string>
     * @see \App\Casts\JsonConvertCast For JSON casting implementation
     */
    protected $casts = [
        'full_name' => JsonConvertCast::class,    // JSON casting for multilingual name
        'subject' => JsonConvertCast::class       // JSON casting for multilingual subject
    ];
    
    // TODO: Add relationships to related models
    // public function programs() - Many-to-many relationship with programs
    // public function groups() - Many-to-many relationship with student groups
    // public function articles() - Has-many relationship for teacher articles/blogs
    
    // TODO: Add scope methods for common queries
    // public function scopeBySubject($query, $subject) - filter by teaching subject
    // public function scopeActive($query) - filter active teachers only
    // public function scopeWithImage($query) - teachers with profile photos
    
    // TODO: Add accessor methods
    // public function getImageUrlAttribute() - get full profile photo URL
    // public function getFullDisplayNameAttribute() - formatted name for display
    // public function getSubjectListAttribute() - comma-separated subject list
    
    // TODO: Add validation methods
    // public function validateProfileImageExists() - check if image file exists
    // public function validateNameTranslations() - ensure both languages present
    
    // TODO: Add helper methods for teacher management
    // public function assignToProgram($programId) - assign teacher to program
    // public function getTeachingLoad() - calculate current teaching workload
    // public function isAvailableForSchedule($datetime) - check availability
}
