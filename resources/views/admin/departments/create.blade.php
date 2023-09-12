@extends('layouts.app')

@section('content')
<div class="container mx-auto py-4">
    <h1 class="text-2xl font-semibold">Create Department</h1>
    <form action="{{ route('departments.store') }}" method="POST" class="mt-4">
        @csrf
        <div class="mb-4">
            <label for="branch_id" class="block font-medium">Select Branch:</label>
            <select name="branch_id" id="branch_id" class="border border-gray-300 rounded p-2 w-full" required>
                <option value="" disabled>Select a Branch</option>
                @foreach ($branches as $branch)
                    <option value="{{ $branch->id }}">{{ $branch->name }}</option>
                @endforeach
            </select>
        </div>
        <div class="mb-4">
            <label for="name" class="block font-medium">Name:</label>
            <input type="text" name="name" id="name" class="border border-gray-300 rounded p-2 w-full" required>
        </div>
        <div class="mb-4">
            <label for="description" class="block font-medium">Description:</label>
            <textarea name="description" id="description" class="border border-gray-300 rounded p-2 w-full" rows="4"></textarea>
        </div>

        <button type="submit" class="bg-blue-500 text-white py-2 px-4 rounded hover:bg-blue-600">Create Department</button>
    </form>
</div>
@endsection
