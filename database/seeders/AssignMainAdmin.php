<?php

namespace Database\Seeders;

use App\Models\Admin;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AssignMainAdmin extends Seeder
{
    public function run(): void
    {
        $user = Admin::find(1);
        $user->assignRole('super_admin');
    }
}
