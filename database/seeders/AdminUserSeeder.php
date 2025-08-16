<?php

namespace Database\Seeders;

use App\Models\AdminUser;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AdminUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Create default super admin user
        AdminUser::firstOrCreate(
            ['email' => 'profgldani@admin.panel'],
            [
                'name' => 'Super Admin',
                'password' => '$AdminPanel2024#', // This will be hashed automatically
                'role' => 'super_admin',
                'is_active' => true
            ]
        );

        // You can add more default admin users here if needed
        AdminUser::firstOrCreate(
            ['email' => 'admin@prof-college.ge'],
            [
                'name' => 'Admin User',
                'password' => 'admin123',
                'role' => 'admin', 
                'is_active' => true
            ]
        );
    }
}
