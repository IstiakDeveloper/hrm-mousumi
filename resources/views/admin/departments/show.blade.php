@extends('layouts.app')

@section('content')
<div class="container mx-auto py-4">
    <h1 class="text-2xl font-semibold">Department Details</h1>
    <p class="mt-4"><strong>Name:</strong> {{ $department->name }}</p>
    <p class="mt-2"><strong>Description:</strong> {{ $department->description }}</p>
    <p class="mt-2"><strong>Associated Branch:</strong> {{ $department->branch->name }}</p>
    <div class="mt-4">
        <a href="{{ route('departments.edit', $department->id) }}" class="bg-blue-500 text-white py-2 px-4 rounded hover:bg-blue-600">Edit</a>
        <form class="inline-block" action="{{ route('departments.destroy', $department->id) }}" method="POST">
            @csrf
            @method('DELETE')
            <button type="submit" class="bg-red-500 text-white py-2 px-4 rounded hover:bg-red-600" onclick="return confirm('Are you sure?')">Delete</button>
        </form>
    </div>
</div>
@endsection
