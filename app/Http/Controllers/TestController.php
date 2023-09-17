<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Spatie\Permission\Traits\HasRoles;

class TestController extends Controller
{
    Use HasRoles;
    public function testDashboardPermission()
    {
        $user = auth()->user();
        $roles = $user->roles; // Get user's roles

        foreach ($roles as $role) {
            $permissions = $role->permissions; // Get permissions for each role
            dd("Role: " . $role->name, $permissions);
        }

        dd("No permissions found for the roles.");
    }
}
