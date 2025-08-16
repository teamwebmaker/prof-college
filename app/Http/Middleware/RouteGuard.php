<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Session;
use App\Models\AdminUser;

class RouteGuard
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        // Check for new admin_user_id session (preferred)
        if (Session::has('admin_user_id')) {
            $adminUser = AdminUser::find(Session::get('admin_user_id'));
            
            if ($adminUser && $adminUser->is_active) {
                // Share authenticated admin user with all views
                view()->share('authAdmin', $adminUser);
                $request->attributes->set('authAdmin', $adminUser);
                return $next($request);
            } else {
                // Invalid or inactive admin user
                Session::forget(['admin', 'admin_user_id']);
            }
        }
        
        // Fallback: Check for old admin session (backward compatibility)
        elseif (Session::has('admin')) {
            return $next($request);
        }
        
        return redirect()->route('admin.login.page', ['language' => app()->getLocale()]);
    }
}
