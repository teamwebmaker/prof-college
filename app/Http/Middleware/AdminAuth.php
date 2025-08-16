<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Symfony\Component\HttpFoundation\Response;
use App\Models\AdminUser;

class AdminAuth
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next, ...$roles): Response
    {
        if (!Session::has('admin_user_id')) {
            return redirect()->route('admin.login.page', ['language' => app()->getLocale()])
                ->with('error', 'გთხოვთ შეიყვანოთ თქვენი მონაცემები');
        }

        $adminUser = AdminUser::find(Session::get('admin_user_id'));
        
        if (!$adminUser || !$adminUser->is_active) {
            Session::forget('admin_user_id');
            return redirect()->route('admin.login.page', ['language' => app()->getLocale()])
                ->with('error', 'თქვენი ანგარიში არაა აქტიური');
        }

        // Check role permissions if specified
        if (!empty($roles) && !in_array($adminUser->role, $roles)) {
            return redirect()->route('admin.dashboard.page', ['language' => app()->getLocale()])
                ->with('error', 'არ გაქვთ ამ გვერდზე წვდომის უფლება');
        }

        // Share authenticated admin user with all views
        view()->share('authAdmin', $adminUser);
        $request->attributes->set('authAdmin', $adminUser);

        return $next($request);
    }
}
