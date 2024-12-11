<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role; // Ensure correct namespace
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class AdminController extends Controller
{
    // Show form for creating a new role and assigning permissions
    public function createRole()
    {
        $permissions = Permission::all();
        $roles = Role::all();
        return view('admin.create-role', compact('permissions', 'roles'));
    }

    // Store the new role and assign permissions
    public function storeRole(Request $request)
    {

        $request->validate([
            'role_name' => 'required|string|max:255|unique:roles,name',
            'permissions' => 'array',
        ]);

        // Create the new role
        $role = Role::create(['name' => $request->role_name]);

        // Assign selected permissions to the role
        if ($request->has('permissions')) {
            foreach ($request->get('permissions') as $permission) {
                $perm = Permission::find($permission);
                $role->givePermissionTo($perm);
            }
        }

        return redirect()->back()->with('success', 'Role created successfully!');
    }

    // Show form for adding a new admin and assigning roles
    public function createAdmin()
    {
        $roles = Role::all();
        $admins = Admin::all();
        return view('admin.create-admin', compact('roles', 'admins'));
    }

    // Store the new admin and assign roles
    public function storeAdmin(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|string|confirmed',
            'roles' => 'array',
        ]);

        // Create a new user
        $admin = Admin::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password),
        ]);

        // Assign selected roles to the user
        if ($request->has('roles')) {
            $admin->syncRoles($request->roles);
        }

        return redirect()->back()->with('success', 'Admin created successfully!');
    }
    public function editAdmin($id)
    {
        $admin = Admin::findOrFail($id);
        $roles = Role::all();
        return view('admin.edit-admin', compact('admin', 'roles'));
    }
    public function updateAdmin(Request $request, $id)
    {
        $admin = Admin::findOrFail($id);

        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $admin->id, // Allow current admin's email
            'password_new' => 'nullable|string|min:8', // Password is optional
            'roles' => 'array',
        ]);

        // Update basic info
        $admin->name = $request->name;
        $admin->email = $request->email;

        // Update password only if provided
        if (!empty($request->password_new)) {
            $admin->password = Hash::make($request->password_new);
        }

        // Sync roles
        if ($request->has('roles')) {
            $admin->syncRoles($request->roles);
        }

        $admin->save();

        return redirect()->route('admin.createAdmin')->with('success', 'Admin updated successfully!');
    }
        public function deleteAdmin($id)
    {
        $admin = Admin::findOrFail($id);
        $admin->delete();

        return redirect()->route('admin.createAdmin')->with('success', 'Admin deleted successfully!');
    }
}
