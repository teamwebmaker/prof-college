<?php

namespace App\Http\Controllers;

use App\Models\Teacher;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;

/**
 * TeacherController handles CRUD operations for the Teacher model
 * 
 * This controller manages teacher profiles including their full names,
 * subjects they teach, and profile images. All text fields support
 * multilingual content (Georgian and English) using JSON casting.
 * 
 * @author Professional College System
 * @version 1.0
 */
class TeacherController extends Controller
{
    /**
     * Display a paginated listing of all teachers
     * 
     * Shows teachers in descending order by ID (newest first) with pagination.
     * Used in admin dashboard to manage teacher records.
     * 
     * @return View Admin teachers index view with paginated teachers
     */
    public function index(): View
    {
        // TODO: Add filtering by subject or search functionality
        // TODO: Consider adding sorting options (name, subject, date)
        return view('admin.teachers.index', [
            'teachers' => Teacher::orderBy('id', 'DESC')->paginate(10)
        ]);
    }

    /**
     * Show the form for creating a new teacher
     * 
     * Displays the teacher creation form with multilingual input fields.
     * Form includes fields for Georgian and English full names, subjects,
     * and profile image upload.
     * 
     * @return View Teacher creation form view
     */
    public function create(): View
    {
        // TODO: Add subject categories or predefined subject list
        // TODO: Consider adding teacher specialization fields
        return view('admin.teachers.create');
    }

    /**
     * Store a newly created teacher in storage
     * 
     * Validates and stores teacher data including image upload handling.
     * Supports multilingual content for name and subject fields.
     * 
     * @param Request $request HTTP request with teacher data
     * @return RedirectResponse Redirect to teachers index with success message
     * 
     * @throws \Illuminate\Validation\ValidationException If validation fails
     */
    public function store(Request $request): RedirectResponse
    {
        // Validate incoming request data
        // TODO: Create dedicated StoreTeacherRequest for better validation
        $data = $request->validate([
            'full_name_ka' => 'required|string|max:255',
            'full_name_en' => 'required|string|max:255', 
            'subject_ka' => 'required|string|max:255',
            'subject_en' => 'required|string|max:255',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048' // 2MB max
        ]);

        // Handle image upload if provided
        $imageName = null;
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            // Generate unique filename to prevent conflicts
            $imageName = uniqid() . '-' . time() . '.' . $image->getClientOriginalExtension();
            $uploadPath = 'images/teachers';
            
            // TODO: Add image resizing/optimization for consistent display
            // TODO: Consider using Laravel Storage facade for cloud storage support
            $image->move(public_path($uploadPath), $imageName);
        }

        // Prepare multilingual data structure for JSON casting
        $fullName = ['ka' => $data['full_name_ka'], 'en' => $data['full_name_en']];
        $subject = ['ka' => $data['subject_ka'], 'en' => $data['subject_en']];
        
        // Create teacher record
        Teacher::create([
            'full_name' => $fullName,
            'subject' => $subject,
            'image' => $imageName
        ]);

        // TODO: Add email notification to admin about new teacher addition
        // TODO: Consider adding teacher profile activation workflow
        
        return redirect()
            ->route('teachers.index', ['language' => app()->getLocale()])
            ->with('success', 'მასწავლებელი წარმატებით დაემატა'); // "Teacher added successfully" in Georgian
    }

    /**
     * Display the specified teacher profile
     * 
     * Shows detailed teacher information including all multilingual content.
     * Used for public teacher profile display and admin review.
     * 
     * @param string $language Current application language (ka/en)
     * @param Teacher $teacher Teacher model instance (route model binding)
     * @return View Teacher detail view
     */
    public function show(string $language, Teacher $teacher): View
    {
        // TODO: Add view counter for teacher profile visits
        // TODO: Add related content (articles, programs taught)
        return view('admin.teachers.show', [
            'teacher' => $teacher
        ]);
    }

    /**
     * Show the form for editing the specified teacher
     * 
     * Displays pre-populated form with current teacher data for editing.
     * Supports updating all teacher information including multilingual content.
     * 
     * @param string $language Current application language
     * @param Teacher $teacher Teacher to edit
     * @return View Teacher edit form view
     */
    public function edit(string $language, Teacher $teacher): View
    {
        // TODO: Add change history/audit log display
        // TODO: Consider adding preview functionality
        return view('admin.teachers.edit', [
            'teacher' => $teacher
        ]);
    }

    /**
     * Update the specified teacher in storage
     * 
     * Updates teacher information with validation and image handling.
     * Preserves existing image if no new image is uploaded.
     * 
     * @param Request $request HTTP request with updated data
     * @param string $language Current application language
     * @param Teacher $teacher Teacher to update
     * @return RedirectResponse Redirect back with success message
     */
    public function update(Request $request, string $language, Teacher $teacher): RedirectResponse
    {
        // Validate updated data
        // TODO: Create UpdateTeacherRequest for better validation rules
        $data = $request->validate([
            'full_name_ka' => 'required|string|max:255',
            'full_name_en' => 'required|string|max:255',
            'subject_ka' => 'required|string|max:255', 
            'subject_en' => 'required|string|max:255',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048'
        ]);

        // Prepare update data
        $fullName = ['ka' => $data['full_name_ka'], 'en' => $data['full_name_en']];
        $subject = ['ka' => $data['subject_ka'], 'en' => $data['subject_en']];
        
        $updateData = [
            'full_name' => $fullName,
            'subject' => $subject
        ];

        // Handle new image upload
        if ($request->hasFile('image')) {
            // TODO: Delete old image file to prevent storage bloat
            $image = $request->file('image');
            $imageName = uniqid() . '-' . time() . '.' . $image->getClientOriginalExtension();
            $uploadPath = 'images/teachers';
            
            $image->move(public_path($uploadPath), $imageName);
            $updateData['image'] = $imageName;
        }

        // Update teacher record
        $teacher->update($updateData);
        
        // TODO: Log teacher profile changes for audit purposes
        // TODO: Send notification to relevant stakeholders about profile updates
        
        return redirect()
            ->back()
            ->with('success', 'მასწავლებლის ინფორმაცია განახლდა'); // "Teacher information updated" in Georgian
    }

    /**
     * Remove the specified teacher from storage
     * 
     * Soft delete or hard delete teacher record based on business requirements.
     * Also handles cleanup of associated image files.
     * 
     * @param string $language Current application language
     * @param Teacher $teacher Teacher to delete
     * @return RedirectResponse Redirect to teachers index with confirmation
     */
    public function destroy(string $language, Teacher $teacher): RedirectResponse
    {
        // TODO: Implement soft deletes to maintain data integrity
        // TODO: Check for related records (courses, articles) before deletion
        // TODO: Archive teacher image instead of deleting
        
        // Clean up associated image file
        if ($teacher->image && file_exists(public_path('images/teachers/' . $teacher->image))) {
            unlink(public_path('images/teachers/' . $teacher->image));
        }
        
        $teacher->delete();
        
        // TODO: Send notification about teacher record deletion
        // TODO: Log deletion action for security audit
        
        return redirect()
            ->route('teachers.index', ['language' => app()->getLocale()])
            ->with('success', 'მასწავლებელი წარმატებით წაიშალა'); // "Teacher successfully deleted" in Georgian
    }
}
