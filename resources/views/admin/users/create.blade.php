@extends('layouts.app')

@section('content')
<div class="container mx-auto py-4">
    <h1 class="text-2xl font-semibold">Create User</h1>
    <form action="{{ route('admin.users.store') }}" method="POST" class="mt-4">
        @csrf
        <div class="mb-4">
            <label for="name" class="block font-medium">Name:</label>
            <input type="text" name="name" id="name" class="border border-gray-300 rounded p-2 w-full" required>
            @error('name')
                <div class="text-red-500 text-sm">{{ $message }}</div>
            @enderror
        </div>
        <div class="mb-4">
            <label for="email" class="block font-medium">Email:</label>
            <input type="email" name="email" id="email" class="border border-gray-300 rounded p-2 w-full" required>
            @error('email')
                <div class="text-red-500 text-sm">{{ $message }}</div>
            @enderror
        </div>
        <div class="mb-4">
            <label for="password" class="block font-medium">Password:</label>
            <input type="password" name="password" id="password" class="border border-gray-300 rounded p-2 w-full" required>
            @error('password')
                <div class="text-red-500 text-sm">{{ $message }}</div>
            @enderror
        </div>
        <div class="mb-4">
            <label for="roles" class="block font-medium">Role:</label>
            <select id="roles" name="roles" class="border border-gray-300 rounded p-2 w-full" required>
                @foreach($roles as $role)
                    <option value="{{ $role->name }}">{{ $role->name }}</option>
                @endforeach
            </select>
            @error('roles')
                <div class="text-red-500 text-sm">{{ $message }}</div>
            @enderror
        </div>

        <button type="submit" class="bg-blue-500 text-white py-2 px-4 rounded hover:bg-blue-600">Create User</button>
    </form>
</div>
@endsection
