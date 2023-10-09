@extends('layouts.app')

@section('content')
<div class="container mx-auto py-4">
    <div class="flex justify-between items-center mb-4">
        <h1 class="text-2xl font-semibold">Departments</h1>
        <a href="{{ route('departments.create') }}" class="bg-blue-500 text-white py-2 px-4 my-2 rounded hover:bg-blue-600">Create Department</a>
    </div>
    @if (count($departments) > 0)
    <table class="min-w-full">
        <thead>
            <tr>
                <th class="py-2 px-4 bg-gray-100">ID</th>
                <th class="py-2 px-4 bg-gray-100">Name</th>
                <th class="py-2 px-4 bg-gray-100">Description</th>
                <th class="py-2 px-4 bg-gray-100">Branch</th>
                <th class="py-2 px-4 bg-gray-100">Actions</th>
            </tr>
        </thead>
        <tbody class="divide-y divide-gray-200">
            @foreach ($departments as $department)
            <tr>
                <td class="py-2 px-4 text-center">{{ $department->id }}</td>
                <td class="py-2 px-4 text-center">{{ $department->name }}</td>
                <td class="py-2 px-4 text-center">{{ $department->description }}</td>
                <td class="py-2 px-4 text-center">{{ $department->branch->name }}</td>
                <td class="py-2 px-4 text-center">
                    <a href="{{ route('departments.show', $department->id) }}" class="text-blue-500 hover:underline">View</a>
                    <a href="{{ route('departments.edit', $department->id) }}" class="text-yellow-500 hover:underline">Edit</a>
                    <form class="inline-block" action="{{ route('departments.destroy', $department->id) }}" method="POST">
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
    <p class="mt-4">No departments found.</p>
    @endif
</div>
@endsection
