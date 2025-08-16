<?php

namespace App\Http\Controllers;

use App\Models\AdminUser;
use App\Models\Article;
use App\Models\Council;
use App\Models\Documentation;
use App\Models\Employer;
use App\Models\Graduated;
use App\Models\Partner;
use App\Models\Profession;
use App\Models\Program;
use App\Models\Staff;
use App\Models\Task;
use App\Models\Teacher;
use App\Models\Vote;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Hash;

class AdminController extends Controller
{
    public function  dashboard()
    {
        // Get recent activities
        $recentArticles = Article::latest()->take(5)->get(['id', 'created_at']);
        $recentUsers = AdminUser::latest()->take(5)->get(['id', 'name', 'created_at']);

        // Calculate growth statistics
        $thisMonth = now()->startOfMonth();
        $lastMonth = now()->subMonth()->startOfMonth();

        $articleGrowth = $this->calculateGrowth(
            Article::where('created_at', '>=', $thisMonth)->count(),
            Article::whereBetween('created_at', [$lastMonth, $thisMonth])->count()
        );

        return view('admin.desk', [
            'articles' => (object) [
                'title' => 'სიახლეები',
                'count' => Article::count(),
                'growth' => $articleGrowth,
                'recent' => $recentArticles
            ],
            'teachers' => (object) [
                'title' => 'პედაგოგები',
                'count' => Teacher::count()
            ],
            'partners' => (object) [
                'title' => 'პარტნიორები',
                'count' => Partner::count()
            ],
            'staff' => (object) [
                'title' => 'ადმინისტრაცია',
                'count' => Staff::count()
            ],
            'councils' => (object) [
                'title' => 'საბჭო',
                'count' => Council::count()
            ],
            'employers' => (object) [
                'title' => 'დამსაქმებლები',
                'count' => Employer::count()
            ],
            'graduates' => (object) [
                'title' => 'კურსდამთავრებულები',
                'count' => Graduated::count()
            ],
            'documents' => (object) [
                'title' => 'დოკუმენტაცია',
                'count' => Documentation::count()
            ],
            'programs' => (object) [
                'title' => 'პროგრამები',
                'count' => Program::count()
            ],
            'professions' => (object) [
                'title' => 'პროფესიები',
                'count' => Profession::count()
            ],
            'tasks' => (object) [
                'title' => 'ტასკები',
                'count' => Task::count()
            ],
            'adminUsers' => (object) [
                'title' => 'ადმინისტრატორები',
                'count' => AdminUser::count(),
                'active' => AdminUser::where('is_active', true)->count(),
                'recent' => $recentUsers
            ],
            'vote' => Vote::all()->first(),
            'systemStats' => (object) [
                'totalContent' => Article::count() + Documentation::count() + Program::count(),
                'totalUsers' => AdminUser::count(),
                'lastLogin' => AdminUser::whereNotNull('last_login_at')->latest('last_login_at')->first(),
                'diskUsage' => $this->getDiskUsage()
            ]
        ]);
    }

    private function calculateGrowth($current, $previous)
    {
        if ($previous == 0) {
            return $current > 0 ? 100 : 0;
        }
        return round((($current - $previous) / $previous) * 100, 1);
    }

    private function getDiskUsage()
    {
        $path = storage_path('app');
        if (is_dir($path)) {
            $size = $this->getDirectorySize($path);
            return $this->formatBytes($size);
        }
        return 'N/A';
    }

    private function getDirectorySize($directory)
    {
        $size = 0;
        foreach (new \RecursiveIteratorIterator(new \RecursiveDirectoryIterator($directory)) as $file) {
            $size += $file->getSize();
        }
        return $size;
    }

    private function formatBytes($size, $precision = 2)
    {
        $units = array('B', 'KB', 'MB', 'GB', 'TB');
        for ($i = 0; $size > 1024 && $i < count($units) - 1; $i++) {
            $size /= 1024;
        }
        return round($size, $precision) . ' ' . $units[$i];
    }


    public function login()
    {
        if (Session::has('admin_user_id')) {
            return redirect()->route('admin.dashboard.page', ['language' => app()->getLocale()]);
        }
        return view('admin.login', ['language' => app()->getLocale()]);
    }

    public function auth(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required|min:6'
        ]);

        $adminUser = AdminUser::where('email', $request->email)
            ->where('is_active', true)
            ->first();

        if (!$adminUser) {
            return redirect()->back()
                ->with('email', 'ელ.ფოსტა არასწორია ან ანგარიში არაა აქტიური')
                ->withInput($request->only('email'));
        }

        if (!Hash::check($request->password, $adminUser->password)) {
            return redirect()->back()
                ->with('password', 'პაროლი არასწორია')
                ->withInput($request->only('email'));
        }

        // Update last login info
        $adminUser->updateLastLogin($request->ip());

        // Store admin user ID in session
        Session::put('admin_user_id', $adminUser->id);
        Session::put('admin', (object) [
            'id' => $adminUser->id,
            'email' => $adminUser->email,
            'name' => $adminUser->name,
            'role' => $adminUser->role
        ]);

        return redirect()->route('admin.dashboard.page', ['language' => app()->getLocale()])
            ->with('success', 'წარმატებით შეხვდით სისტემაში');
    }

    public function logout()
    {
        Session::forget(['admin', 'admin_user_id']);
        return redirect()->route('admin.login.page', ['language' => app()->getLocale()])
            ->with('success', 'წარმატებით გაიხვეწეთ სისტემიდან');
    }
}
