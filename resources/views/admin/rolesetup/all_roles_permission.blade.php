@extends('layouts.app')

@section('content')
<div class="container mx-auto py-4">
    <div class="flex justify-between items-center mb-4">
        <h1 class="text-2xl font-semibold">All Roles Permission</h1>
        <div class="flex justify-end">
            <a href="{{ route('role.create') }}" class="bg-blue-500 text-white py-2 px-4 m-2 rounded hover:bg-blue-600">Create Role</a>
        </div>
    </div>
    @if (count($roles) > 0)
    <table class="min-w-full">
        <thead>
            <tr>
                <th class="py-2 px-4 bg-gray-100">ID</th>
                <th class="py-2 px-4 bg-gray-100">Roles Name</th>
                <th class="py-2 px-4 bg-gray-100">Permissions Name</th>
                <th class="py-2 px-4 bg-gray-100">Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($roles as $key => $item )
            <tr>
                <td class="py-2 px-4 text-center">{{ $key+1 }}</td>
                <td class="py-2 px-4 text-center">{{ $item->name }}</td>
                <td class="py-2 px-4 text-center">
                    @foreach ($item->permissions as $prem)
                        <span class="bg-red-500 p-1 text-white">{{$prem->name}}</span>
                    @endforeach
                </td>
                <td class="py-2 px-4 text-center">
                    <a href="{{ route('role.edit', $item->id) }}" class="text-yellow-500 hover:underline">Edit</a>
                    <form class="inline-block" action="{{ route('role.destroy', $item->id) }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="text-red-500 hover:underline" onclick="return confirm('Are you sure?')">Delete</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
    @else
    <p class="mt-4">No role found.</p>
    @endif
</div>
@endsection
