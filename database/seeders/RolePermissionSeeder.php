<?php

namespace Database\Seeders;

use App\Models\Admin;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RolePermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $adminRole = Role::create(['name' => 'super_admin', 'guard_name' => 'admin']);

        $permissions = [
            'اقسام الصفحة الرئيسية',  // Main page sections
            'تبرعات من خلال مندوبين',  // Donations through representatives
            'تبرعات عن طريق الفيزا',  // Donations via Visa
            'الفروع',                  // Branches
            'جهات التطوع',             // Volunteering entities
            'الانشطة',                  // Activities
            'طلبات التطوع',            // Volunteering requests
            'التبرع بالدم',            // Blood donation
            'المقالات',              // Articles
            'الفاعليات',             // Events
            'الصفحات',               // Pages
        ];

        foreach ($permissions as $permission) {
            $perm = Permission::create(['name' => $permission, 'guard_name' => 'admin']);
            $adminRole->givePermissionTo($perm);
        }

    }
}
