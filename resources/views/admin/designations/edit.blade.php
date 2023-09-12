@extends('layouts.app')

@section('content')
<div class="container mx-auto py-4">
    <h1 class="text-2xl font-semibold">Edit Designation</h1>
    <form action="{{ route('designations.update', $designation) }}" method="POST" class="mt-4">
        @csrf
        @method('PUT')
        <div class="mb-4">
            <label for="department_id" class="block font-medium">Department:</label>
            <select name="department_id" id="department_id" class="border border-gray-300 rounded p-2 w-full" required>
                @foreach ($departments as $department)
                <option value="{{ $department->id }}" {{ $department->id == $designation->department_id ? 'selected' : '' }}>{{ $department->name }}</option>
                @endforeach
            </select>
        </div>
        <div class="mb-4">
            <label for="name" class="block font-medium">Designation Name:</label>
            <input type="text" name="name" id="name" class="border border-gray-300 rounded p-2 w-full" value="{{ $designation->name }}" required>
        </div>
        <div class="mb-4">
            <label for="description" class="block font-medium">Description:</label>
            <textarea name="description" id="description" class="border border-gray-300 rounded p-2 w-full" rows="4">{{ $designation->description }}</textarea>
        </div>
        <button type="submit" class="bg-blue-500 text-white py-2 px-4 rounded hover:bg-blue-600">Update Designation</button>
    </form>
</div>
@endsection
