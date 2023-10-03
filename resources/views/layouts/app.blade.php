<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Tailwind CSS -->
    <link href="https://unpkg.com/tailwindcss@^2.0/dist/tailwind.min.css" rel="stylesheet">

    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css">

    <style>
        /* Additional CSS for styling */
        .sidebar {
            min-width: 230px;
            transition: all 0.3s;
        }

        .sidebar a {
            padding: 1rem 2.4rem;
            color: #ffffff;
            text-decoration: none;
            transition: background-color 0.3s ease;
        }

        .sidebar a:hover {
            background-color: rgba(255, 255, 255, 0.1);
        }

        .sidebar .active-menu {
            background-color: rgba(255, 255, 255, 0.2);
            border-r: 3px solid #ffffff;
        }
    </style>
</head>
<body class="bg-gray-100 font-sans">
    <!-- Sidebar -->
    <aside class="sidebar bg-gray-900 text-white fixed h-full overflow-y-auto">
        <div class="p-4">
            <!-- Logo -->
            {{-- <img src="path_to_logo_image" alt="Logo" class="w-32 h-32 mx-auto"> --}}
            <h1 class="text-xl text-center fonta-bold">HRM ADMIN</h1>
        </div>

        <!-- Sidebar Navigation -->
        <nav class="px-4">
            <ul>
                <!-- Dashboard -->
                <li class="mb-2">
                    <a href="{{ route('dashboard') }}" class="nav-menu-item flex items-center hover:bg-gray-800 {{ request()->routeIs('dashboard') ? 'active-menu' : '' }}">
                        <span class="w-6"><i class="fas fa-tachometer-alt"></i></span>
                        <span class="ml-2">Dashboard</span>
                    </a>
                </li>

                <!-- HRM Setup -->
                <li class="mb-2 relative">
                    <a href="#" class="nav-menu-item flex items-center hover:bg-gray-800 {{ request()->routeIs('branches.*', 'departments.*', 'designations.*', 'leave_types.*') ? 'active-menu' : '' }}" onclick="toggleDropdown('settings-dropdown')">
                        <span class="w-6"><i class="fas fa-cogs"></i></span>
                        <span class="ml-2">HRM Setup</span>
                        <span class="ml-auto">
                            <i id="settings-icon" class="fas fa-chevron-right transform transition-transform duration-200"></i>
                        </span>
                    </a>
                    <!-- Dropdown Items - HRM Setup -->
                    <ul id="settings-dropdown" class="hidden mt-2 space-y-2 bg-gray-800 text-gray-300 dropdown">
                        <li><a href="{{ route('branches.index') }}" class="block px-4 py-2 hover:bg-gray-700 {{ request()->routeIs('branches.*') ? 'active-menu' : '' }}">Branches</a></li>
                        <li><a href="{{ route('departments.index') }}" class="block px-4 py-2 hover:bg-gray-700 {{ request()->routeIs('departments.*') ? 'active-menu' : '' }}">Department</a></li>
                        <li><a href="{{ route('designations.index') }}" class="block px-4 py-2 hover:bg-gray-700 {{ request()->routeIs('designations.*') ? 'active-menu' : '' }}">Designation</a></li>
                        <li><a href="{{ route('leave_types.index') }}" class="block px-4 py-2 hover:bg-gray-700 {{ request()->routeIs('leave_types.*') ? 'active-menu' : '' }}">Leave Type</a></li>
                        <li><a href="{{ route('payslip_types.index') }}" class="block px-4 py-2 hover:bg-gray-700 {{ request()->routeIs('payslip_types.*') ? 'active-menu' : '' }}">Payslip Type</a></li>
                        <li><a href="{{ route('allowance_options.index') }}" class="block px-4 py-2 hover:bg-gray-700 {{ request()->routeIs('allowance_options.*') ? 'active-menu' : '' }}">Allowance Option</a></li>
                        <li><a href="{{ route('deduction_options.index') }}" class="block px-4 py-2 hover:bg-gray-700 {{ request()->routeIs('deduction_options.*') ? 'active-menu' : '' }}">Deduction Option</a></li>
                        <li><a href="{{ route('loan_options.index') }}" class="block px-4 py-2 hover:bg-gray-700 {{ request()->routeIs('loan_options.*') ? 'active-menu' : '' }}">Loan Option</a></li>
                    </ul>
                </li>

                <!-- Employee -->
                <li class="mb-2">
                    <a href="{{ route('employees.index') }}" class="nav-menu-item flex items-center hover:bg-gray-800 {{ request()->routeIs('employees.index') ? 'active-menu' : '' }}">
                        <span class="w-6"><i class="fa-regular fa-user"></i></span>
                        <span class="ml-2">Employee</span>
                    </a>
                </li>

                <!-- Timesheets -->
                <li class="mb-2 relative">
                    <a href="#" class="nav-menu-item flex items-center hover:bg-gray-800 {{ request()->routeIs('timesheets.*', 'leave.*', 'attendances.*') ? 'active-menu' : '' }}" onclick="toggleDropdown('timesheet-dropdown')">
                        <span class="w-6"><i class="fa-solid fa-clock"></i></span>
                        <span class="ml-2">Timesheets</span>
                        <span class="ml-auto">
                            <i id="settings-icon" class="fas fa-chevron-right transform transition-transform duration-200"></i>
                        </span>
                    </a>
                    <!-- Dropdown Items - Timesheets -->
                    <ul id="timesheet-dropdown" class="hidden mt-2 space-y-2 bg-gray-800 text-gray-300 dropdown">
                        <li><a href="{{ route('timesheets.index') }}" class="block px-4 py-2 hover:bg-gray-700 {{ request()->routeIs('timesheets.*') ? 'active-menu' : '' }}">Timesheets</a></li>
                        <li><a href="{{ route('leave.index') }}" class="block px-4 py-2 hover:bg-gray-700 {{ request()->routeIs('leave.*') ? 'active-menu' : '' }}">Leaves</a></li>
                        <li><a href="{{ route('attendances.index') }}" class="block px-4 py-2 hover:bg-gray-700 {{ request()->routeIs('attendances.*') ? 'active-menu' : '' }}">Attendance</a></li>
                    </ul>
                </li>

                <!-- Role & Permission -->
                <li class="mb-2 relative">
                    <a href="#" class="nav-menu-item flex items-center hover:bg-gray-800 {{ request()->routeIs('all.permission', 'role.all', 'roles.permission.all') ? 'active-menu' : '' }}" onclick="toggleDropdown('permission-dropdown')">
                        <span class="w-6"><i class="fa-solid fa-thumbtack"></i></span>
                        <span class="ml-2">Role & Permission</span>
                        <span class="ml-auto">
                            <i id="permission-icon" class="fas fa-chevron-right transform transition-transform duration-200"></i>
                        </span>
                    </a>
                    <!-- Dropdown Items - Role & Permission -->
                    <ul id="permission-dropdown" class="hidden mt-2 space-y-2 bg-gray-800 text-gray-300 dropdown">
                        <li><a href="{{ route('all.permission') }}" class="block px-4 py-2 hover:bg-gray-700 {{ request()->routeIs('all.permission') ? 'active-menu' : '' }}">All Permissions</a></li>
                        <li><a href="{{ route('role.all') }}" class="block px-4 py-2 hover:bg-gray-700 {{ request()->routeIs('role.all') ? 'active-menu' : '' }}">All Roles</a></li>
                        <li><a href="{{ route('roles.permission.all') }}" class="block px-4 py-2 hover:bg-gray-700 {{ request()->routeIs('roles.permission.all') ? 'active-menu' : '' }}">All Roles in Permission</a></li>
                    </ul>
                </li>

                <!-- Users -->
                <li class="mb-2">
                    <a href="{{ route('all.users') }}" class="nav-menu-item flex items-center hover:bg-gray-800 {{ request()->routeIs('all.users') ? 'active-menu' : '' }}">
                        <span class="w-6"><i class="fas fa-users"></i></span>
                        <span class="ml-2">Users</span>
                    </a>
                </li>
            </ul>
        </nav>

        <div class="mt-16 +w-full text-center py-4">
            <!-- Default Avatar Placeholder -->
            <div class="flex justify-center mb-2">
                <div class="bg-gray-300 rounded-full w-12 h-12 flex items-center justify-center">
                    <i class="fas fa-user text-gray-600"></i>
                </div>
            </div>
            <!-- Logout Button -->
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit" class="text-gray-400 hover:text-white">Logout</button>
            </form>
        </div>
    </aside>

    <!-- Content Area -->
    <main class="ml-72 p-6">
        @yield('content')
    </main>

    <!-- Font Awesome CDN (for icons) -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/js/all.min.js"></script>

    <script>
        function toggleDropdown(dropdownId) {
            const dropdown = document.getElementById(dropdownId);
            const icon = document.querySelector(`#${dropdownId} .fa-chevron-right`);

            // Toggle the 'hidden' class and rotate the icon
            dropdown.classList.toggle('hidden');
            icon.classList.toggle('rotate-90');
        }
    </script>
</body>
</html>
