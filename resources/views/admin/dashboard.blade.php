<!-- view/admin/dashboard.blade.php -->

User ID: {{ $user->id }}
User Name: {{ $user->name }}

User Roles:
<ul>
    @foreach ($user->roles as $role)
        <li>{{ $role->name }}</li>
    @endforeach
</ul>

User Permissions:
<ul>
    @foreach ($user->permissions() as $permission)
        <li>{{ $permission }}</li>
    @endforeach
</ul>
