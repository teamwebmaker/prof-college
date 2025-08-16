<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Support\Facades\Hash;
use Carbon\Carbon;

class AdminUser extends Authenticatable
{
    use HasFactory;

    protected $fillable = [
        'name',
        'email', 
        'password',
        'role',
        'is_active',
        'last_login_at',
        'last_login_ip'
    ];

    protected $hidden = [
        'password',
    ];

    protected $casts = [
        'last_login_at' => 'datetime',
        'is_active' => 'boolean'
    ];

    public function setPasswordAttribute($value)
    {
        $this->attributes['password'] = Hash::make($value);
    }

    public function updateLastLogin($ip = null)
    {
        $this->update([
            'last_login_at' => Carbon::now(),
            'last_login_ip' => $ip
        ]);
    }

    public function isSuperAdmin()
    {
        return $this->role === 'super_admin';
    }

    public function canManageUsers()
    {
        return in_array($this->role, ['super_admin', 'admin']);
    }

    public function canEditContent()
    {
        return in_array($this->role, ['super_admin', 'admin', 'editor']);
    }
}
