<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
        {{-- <script src="https://cdn.tailwindcss.com"></script> --}}

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="bg-gray-100 font-sans">
        <!-- Sidebar -->
        <aside class="bg-gray-900 text-white w-64 h-full fixed overflow-y-auto">
            <!-- Sidebar Logo -->
            <div class="p-4">
                <h1 class="text-2xl font-bold">HRM Admin Panel</h1>
            </div>
            <!-- Sidebar Navigation -->
            <nav class="px-4">
                <ul>
                    <!-- Dashboard -->
                    <li class="mb-2">
                        <a href="#" class="flex items-center text-gray-400 hover:text-white active-menu" onclick="toggleDropdown('dashboard-dropdown')">
                            <span class="w-6"><i class="fas fa-tachometer-alt"></i></span>
                            <span class="ml-2">Dashboard</span>
                        </a>
                    </li>
                    <!-- Dropdown Menu - Settings -->
                    <li class="mb-2 relative">
                        <a href="#" class="flex items-center text-gray-400 hover:text-white" onclick="toggleDropdown('settings-dropdown')">
                            <span class="w-6"><i class="fas fa-cogs"></i></span>
                            <span class="ml-2">HRM Setup</span>
                            <span class="ml-auto">
                                <i id="settings-icon" class="fas fa-chevron-right transform transition-transform duration-200"></i>
                            </span>
                        </a>
                        <!-- Dropdown Items - Settings -->
                        <ul id="settings-dropdown" class="hidden mt-2 space-y-2 bg-gray-800 text-gray-300">
                            <li><a href="{{route('branches.index')}}" class="block px-4 py-2 hover:bg-gray-700">Branches</a></li>
                            <li><a href="{{route('departments.index')}}" class="block px-4 py-2 hover:bg-gray-700">Department</a></li>
                            <li><a href="{{route('designations.index')}}" class="block px-4 py-2 hover:bg-gray-700">Designation</a></li>
                        </ul>
                    </li>
                    <li class="mb-2">
                        <a href="{{route('employees.index')}}" class="flex items-center text-gray-400 hover:text-white active-menu" onclick="toggleDropdown('dashboard-dropdown')">
                            <span class="w-6"><i class="fa-regular fa-user"></i></span>
                            <span class="ml-2">Employee</span>
                        </a>
                    </li>

                    <!-- Dropdown Menu - Permission -->
                    <li class="mb-2 relative">
                        <a href="#" class="flex items-center text-gray-400 hover:text-white" onclick="toggleDropdown('permission-dropdown')">
                            <span class="w-6"><i class="fa-solid fa-thumbtack"></i></span>
                            <span class="ml-2">Role & Permission</span>
                            <span class="ml-auto">
                                <i id="permission-icon" class="fas fa-chevron-right transform transition-transform duration-200"></i>
                            </span>
                        </a>
                        <!-- Dropdown Items - permission -->
                        <ul id="permission-dropdown" class="hidden mt-2 space-y-2 bg-gray-800 text-gray-300">
                            <li><a href="{{route('all.permission')}}" class="block px-4 py-2 hover:bg-gray-700">All Permissions</a></li>
                            <li><a href="{{route('role.all')}}" class="block px-4 py-2 hover:bg-gray-700">All Roles</a></li>
                            <li><a href="{{route('add.roles.permission')}}" class="block px-4 py-2 hover:bg-gray-700">Roles in Permission</a></li>
                            <li><a href="{{route('roles.permission.all')}}" class="block px-4 py-2 hover:bg-gray-700">All Roles in Permission</a></li>
                        </ul>
                    </li>

                    <!-- Dropdown Menu - Users -->
                    <li class="mb-2 relative">
                        <a href="#" class="flex items-center text-gray-400 hover:text-white" onclick="toggleDropdown('users-dropdown')">
                            <span class="w-6"><i class="fas fa-users"></i></span>
                            <span class="ml-2">Users</span>
                            <span class="ml-auto">
                                <i id="users-icon" class="fas fa-chevron-right transform transition-transform duration-200"></i>
                            </span>
                        </a>
                        <!-- Dropdown Items - Users -->
                        <ul id="users-dropdown" class="hidden mt-2 space-y-2 bg-gray-800 text-gray-300">
                            <li><a href="#" class="block px-4 py-2 hover:bg-gray-700">All Users</a></li>
                            <li><a href="#" class="block px-4 py-2 hover:bg-gray-700">Active Users</a></li>
                            <li><a href="#" class="block px-4 py-2 hover:bg-gray-700">Inactive Users</a></li>
                        </ul>
                    </li>
                    <!-- Dropdown Menu - Products -->
                    <li class="mb-2 relative">
                        <a href="#" class="flex items-center text-gray-400 hover:text-white" onclick="toggleDropdown('products-dropdown')">
                            <span class="w-6"><i class="fas fa-shopping-cart"></i></span>
                            <span class="ml-2">Products</span>
                            <span class="ml-auto">
                                <i id="products-icon" class="fas fa-chevron-right transform transition-transform duration-200"></i>
                            </span>
                        </a>
                        <!-- Dropdown Items - Products -->
                        <ul id="products-dropdown" class="hidden mt-2 space-y-2 bg-gray-800 text-gray-300">
                            <li><a href="#" class="block px-4 py-2 hover:bg-gray-700">All Products</a></li>
                            <li><a href="#" class="block px-4 py-2 hover:bg-gray-700">New Arrivals</a></li>
                            <li><a href="#" class="block px-4 py-2 hover:bg-gray-700">Best Sellers</a></li>
                        </ul>
                    </li>
                </ul>
            </nav>
        </aside>

        <!-- Content Area -->
        <main class="ml-64 p-6">
            <!-- Page Content Goes Here -->
            @yield('content')
        </main>

        <!-- Font Awesome CDN (for icons) -->
        <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/js/all.min.js"></script>

        <script>
            // JavaScript function to toggle the dropdown
            function toggleDropdown(dropdownId) {
                const dropdown = document.getElementById(dropdownId);
                const iconId = `${dropdownId}-icon`;
                const icon = document.getElementById(iconId);

                // Close all other open dropdowns
                const dropdowns = document.querySelectorAll('.dropdown');
                dropdowns.forEach((item) => {
                    if (item.id !== dropdownId) {
                        item.style.display = 'none';
                        const otherIconId = `${item.id}-icon`;
                        const otherIcon = document.getElementById(otherIconId);
                        otherIcon.classList.remove('rotate-90');
                    }
                });

                if (dropdown.style.display === 'block') {
                    dropdown.style.display = 'none';
                    icon.classList.remove('rotate-90');
                } else {
                    dropdown.style.display = 'block';
                    icon.classList.add('rotate-90');
                }
            }
        </script>
    </body>
</html>
