@extends('layouts.app')

@section('content')
<div class="container mx-auto py-4">
    <div class="flex justify-between items-center mb-4">
        <h1 class="text-2xl font-semibold">Designations</h1>
        <a href="{{ route('designations.create') }}" class="bg-blue-500 text-white py-2 px-4 my-2 rounded hover:bg-blue-600">Create Designation</a>
    </div>
    @if (count($designations) > 0)
    <table class="min-w-full">
        <thead>
            <tr>
                <th class="py-2 px-4 bg-gray-100">ID</th>
                <th class="py-2 px-4 bg-gray-100">Department</th>
                <th class="py-2 px-4 bg-gray-100">Name</th>
                <th class="py-2 px-4 bg-gray-100">Description</th>
                <th class="py-2 px-4 bg-gray-100">Actions</th>
            </tr>
        </thead>
        <tbody class="divide-y divide-gray-200">
            @foreach ($designations as $designation)
            <tr>
                <td class="py-2 px-4 text-center">{{ $designation->id }}</td>
                <td class="py-2 px-4 text-center">{{ $designation->department->name }}</td>
                <td class="py-2 px-4 text-center">{{ $designation->name }}</td>
                <td class="py-2 px-4 text-center">{{ $designation->job_description }}</td>
                <td class="py-2 px-4 text-center">
                    <a href="{{ route('designations.show', $designation) }}" class="text-blue-500 hover:underline">View</a>
                    <a href="{{ route('designations.edit', $designation) }}" class="text-yellow-500 hover:underline">Edit</a>
                    <form class="inline-block" action="{{ route('designations.destroy', $designation) }}" method="POST">
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
    <p class="mt-4">No designations found.</p>
    @endif
</div>
@endsection
