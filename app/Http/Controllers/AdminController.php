<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Hash;
use App\Models\User;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;

class AdminController extends Controller
{

    public function createSuperAdmin( Request $request)
    {
        // Find or create the user with the email 'superadmin@example.com'
        $user = User::firstOrCreate(
            ['email' => 'superadmin@mousumi.com'],
            [
                'name' => 'Super Admin',
                'password' => Hash::make('mousumipassword'),
                'role_id' => null, // Set role_id to null initially
            ]
        );

        // Check if the 'superadmin' role exists, if not, create it
        $superadminRole = Role::firstOrCreate(['name' => 'superadmin']);

        // Assign the 'superadmin' role to the user
        $user->role_id = $superadminRole->id; // Set the role_id
        $user->save();

        if($request->roles) {
            $user->assignRole($request->roles);
        }

        return redirect()->route('dashboard');
    }


    public function AllUsers() {
        $allusers = User::all();
        return view('admin.users.all_users', compact('allusers'));
    }

    public function CreateUser()
    {
        $roles = Role::all();
        return view('admin.users.create', compact('roles'));
    }

    public function store(Request $request)
    {
        // Validate form input
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8',
            'role' => 'required|exists:roles,name', // Ensure the role exists
        ]);

        // Find the role by name
        $role = Role::where('name', $request->role)->first();

        // Create the user with the role_id if the role exists
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role_id' => $role ? $role->id : null,
        ]);
        if($request->roles) {
            $user->assignRole($request->roles);
        }

        return redirect()->route('all.users')->with('success', 'User created successfully.');
    }



}
