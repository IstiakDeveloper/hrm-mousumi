<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller

{
    public function showRolesAndPermissions()
    {
        $user = Auth::user();

        return view('admin.dashboard', compact('user'));
    }
}