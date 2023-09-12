@extends('layouts.app')

@section('content')
<div class="container mx-auto py-4">
    <h1 class="text-2xl font-semibold">Designation Details</h1>
    <p class="mt-4"><strong>ID:</strong> {{ $designation->id }}</p>
    <p class="mt-2"><strong>Department:</strong> {{ $designation->department->name }}</p>
    <p class="mt-2"><strong>Name:</strong> {{ $designation->name }}</p>
    <p class="mt-2"><strong>Description:</strong> {{ $designation->description }}</p>
    <div class="mt-4">
        <a href="{{ route('designations.edit', $designation) }}" class="bg-blue-500 text-white py-2 px-4 rounded hover:bg-blue-600">Edit</a>
        <form class="inline-block" action="{{ route('designations.destroy', $designation) }}" method="POST">
            @csrf
            @method('DELETE')
            <button type="submit" class="bg-red-500 text-white py-2 px-4 rounded hover:bg-red-600" onclick="return confirm('Are you sure?')">Delete</button>
        </form>
    </div>
</div>
@endsection
