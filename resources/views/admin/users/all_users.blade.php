@extends('layouts.app')

@section('content')
<div class="container mx-auto py-4">
    <div class="flex justify-between items-center mb-4">
        <h1 class="text-2xl font-semibold">All Users</h1>
        <div class="flex justify-end">
            <a href="{{ route('user.create') }}" class="bg-blue-500 text-white py-2 px-4 m-2 rounded hover:bg-blue-600">Create Role</a>
        </div>
    </div>
    @if (count($allusers) > 0)
    <table class="min-w-full">
        <thead>
            <tr>
                <th class="py-2 px-4 bg-gray-100">ID</th>
                <th class="py-2 px-4 bg-gray-100">Name</th>
                <th class="py-2 px-4 bg-gray-100">Email</th>
                <th class="py-2 px-4 bg-gray-100">Role</th>
            </tr>
        </thead>
        <tbody>

                @foreach($allusers as $key => $user)
                    <tr>
                        <td class="py-2 px-4 text-center">{{ $key+1 }}</td>
                        <td class="py-2 px-4 text-center">{{ $user->name }}</td>
                        <td class="py-2 px-4 text-center">{{ $user->email }}</td>
                        <td class="py-2 px-4 text-center">{{ optional($user->role)->name }}</td>
                    </tr>
                @endforeach
        </tbody>
    </table>
    @else
    <p class="mt-4">No User found.</p>
    @endif
</div>
@endsection
