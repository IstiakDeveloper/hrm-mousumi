@extends('layouts.app')

@section('content')
<div class="container mx-auto py-4">
    <h1 class="text-2xl font-semibold">Create Role</h1>
    <form action="{{ route('role.store') }}" method="POST" class="mt-4">
        @csrf
        <div class="mb-4">
            <label for="name" class="block font-medium">Name:</label>
            <input type="text" name="name" id="name" class="border border-gray-300 rounded p-2 w-full" required>
        </div>
        <button type="submit" class="bg-blue-500 text-white py-2 px-4 rounded hover:bg-blue-600">Create Role</button>
    </form>
</div>
@endsection
