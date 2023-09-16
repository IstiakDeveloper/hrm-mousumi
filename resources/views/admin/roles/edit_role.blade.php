@extends('layouts.app')

@section('content')
<div class="container mx-auto py-4">
    <h1 class="text-2xl font-semibold">Edit Role </h1>
    <form action="{{ route('role.update') }}" method="POST" class="mt-4">
        @csrf

        <input type="hidden" name="id" value="{{$role->id}}">

        <div class="mb-4">
            <label for="name" class="block font-medium">Name:</label>
            <input type="text" name="name" id="name" class="border border-gray-300 rounded p-2 w-full" value="{{$role->name}}" required>
        </div>
        <button type="submit" class="bg-blue-500 text-white py-2 px-4 rounded hover:bg-blue-600">Update Role</button>
    </form>
</div>
@endsection
