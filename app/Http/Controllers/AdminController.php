<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Auth;

class AdminController extends Controller
{

    public function createSuperAdmin(Request $request)
{
    $roleName = $request->roles ?: 'superadmin';
    $role = Role::firstOrCreate(['name' => $roleName]);
    // Find or create the user with the email 'superadmin@example.com'
    $user = User::firstOrCreate(
        ['email' => 'superadmin@mousumi.com'],
        [
            'name' => 'Super Admin',
            'password' => Hash::make('mousumipassword'),
            'role_id' => $role->id,
        ]
    );
    $user->assignRole($role);

    // Check if the 'superadmin' role exists, if not, create it

    // Assign the 'superadmin' role to the user
    // $user->assignRole($superadminRole);

    // if ($request->roles) {
    //     $user->assignRole($request->roles);
    // }

    // Log in the user
    Auth::login($user);

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

        $role = Role::where('name', $request->roles)->first();
        $user = new User();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = Hash::make($request->password);
        if ($role) {
            $user->role_id = $role->id;
        } else {
            dd('Role Is not found');
        }

        $user->save();

        if ($request->roles) {
            $user->assignRole($request->roles);
        }

        // Validate form input
        // $request->validate([
        //     'name' => 'required|string|max:255',
        //     'email' => 'required|string|email|max:255|unique:users',
        //     'password' => 'required|string|min:8',
        //     'role' => 'required|exists:roles,name', // Ensure the role exists
        // ]);

        // // Find the role by name
        // $role = Role::where('name', $request->role)->first();

        // // Create the user with the role_id if the role exists
        // $user = User::create([
        //     'name' => $request->name,
        //     'email' => $request->email,
        //     'password' => Hash::make($request->password),
        //     'role_id' => $role ? $role->id : null,
        // ]);
        // if($request->roles) {
        //     $user->assignRole($request->roles);
        // }

        return redirect()->route('all.users')->with('success', 'User created successfully.');
    }


    public function deleteUser($id)
    {

        // Find the user by ID
        $user = User::findOrFail($id);

        // Delete related employees based on user's email
        Employee::where('email', $user->email)->delete();


        return redirect()->route('all.users')->with('success', 'User and associated records deleted successfully.');
    }

}
