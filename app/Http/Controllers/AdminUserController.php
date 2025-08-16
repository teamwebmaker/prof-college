<?php

namespace App\Http\Controllers;

use App\Models\AdminUser;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;

class AdminUserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = AdminUser::query();

        // Search functionality
        if ($request->has('search') && $request->search) {
            $query->where(function ($q) use ($request) {
                $q->where('name', 'like', '%' . $request->search . '%')
                    ->orWhere('email', 'like', '%' . $request->search . '%');
            });
        }

        // Filter by role
        if ($request->has('role') && $request->role) {
            $query->where('role', $request->role);
        }

        // Filter by status
        if ($request->has('status') && $request->status !== '') {
            $query->where('is_active', $request->status);
        }

        $adminUsers = $query->orderBy('created_at', 'desc')->paginate(10);

        return view('admin.admin-users.index', compact('adminUsers'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.admin-users.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:admin_users,email',
            'password' => 'required|min:8|confirmed',
            'role' => 'required|in:super_admin,admin,editor',
            'is_active' => 'boolean'
        ]);

        AdminUser::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => $request->password,
            'role' => $request->role,
            'is_active' => $request->has('is_active')
        ]);

        return redirect()->route('admin-users.index', ['language' => app()->getLocale()])
            ->with('success', 'ადმინისტრატორი წარმატებით დაემატა');
    }

    /**
     * Display the specified resource.
     */
    public function show(AdminUser $adminUser)
    {
        return view('admin.admin-users.show', compact('adminUser'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(AdminUser $adminUser)
    {
        return view('admin.admin-users.edit', compact('adminUser'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, AdminUser $adminUser)
    {
        $rules = [
            'name' => 'required|string|max:255',
            'email' => ['required', 'email', Rule::unique('admin_users')->ignore($adminUser->id)],
            'role' => 'required|in:super_admin,admin,editor',
            'is_active' => 'boolean'
        ];

        if ($request->filled('password')) {
            $rules['password'] = 'min:8|confirmed';
        }

        $request->validate($rules);

        $data = [
            'name' => $request->name,
            'email' => $request->email,
            'role' => $request->role,
            'is_active' => $request->has('is_active')
        ];

        if ($request->filled('password')) {
            $data['password'] = $request->password;
        }

        $adminUser->update($data);

        return redirect()->route('admin-users.index', ['language' => app()->getLocale()])
            ->with('success', 'ადმინისტრატორი წარმატებით განახლდა');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(AdminUser $adminUser)
    {
        // Prevent deletion of super admin or current user
        if ($adminUser->isSuperAdmin() || $adminUser->id == session('admin_user_id')) {
            return redirect()->route('admin-users.index', ['language' => app()->getLocale()])
                ->with('error', 'ამ ადმინისტრატორის წაშლა შეუძლებელია');
        }

        $adminUser->delete();

        return redirect()->route('admin-users.index', ['language' => app()->getLocale()])
            ->with('success', 'ადმინისტრატორი წარმატებით წაიშალა');
    }

    /**
     * Toggle user status
     */
    public function toggleStatus(AdminUser $adminUser)
    {
        if ($adminUser->isSuperAdmin()) {
            return redirect()->back()
                ->with('error', 'სუპერ ადმინისტრატორის სტატუსის ცვლილება შეუძლებელია');
        }

        $adminUser->update(['is_active' => !$adminUser->is_active]);

        $status = $adminUser->is_active ? 'გააქტიურდა' : 'დეაქტივირდა';

        return redirect()->back()
            ->with('success', "ადმინისტრატორი წარმატებით {$status}");
    }
}
