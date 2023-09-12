@extends('layouts.app')

@section('content')
<div class="container mx-auto py-4">
    <h1 class="text-2xl font-semibold">Edit Department</h1>
    <form action="{{ route('departments.update', $department->id) }}" method="POST" class="mt-4">
        @csrf
        @method('PUT')
        <div class="mb-4">
            <label for="branch_id" class="block font-medium">Select Branch:</label>
            <select name="branch_id" id="branch_id" class="border border-gray-300 rounded p-2 w-full" required>
                <option value="" disabled>Select a Branch</option>
                @foreach ($branches as $branch)
                    <option value="{{ $branch->id }}" @if($branch->id == $department->branch_id) selected @endif>{{ $branch->name }}</option>
                @endforeach
            </select>
        </div>
        <div class="mb-4">
            <label for="name" class="block font-medium">Name:</label>
            <input type="text" name="name" id="name" class="border border-gray-300 rounded p-2 w-full" value="{{ $department->name }}" required>
        </div>
        <div class="mb-4">
            <label for="description" class="block font-medium">Description:</label>
            <textarea name="description" id="description" class="border border-gray-300 rounded p-2 w-full" rows="4">{{ $department->description }}</textarea>
        </div>
        <button type="submit" class="bg-blue-500 text-white py-2 px-4 rounded hover:bg-blue-600">Update Department</button>
    </form>
</div>
@endsection
