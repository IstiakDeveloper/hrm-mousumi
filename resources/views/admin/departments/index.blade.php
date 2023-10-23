@extends('layouts.app')

@section('content')
<div class="container mx-auto py-4">
    <div class="flex justify-between items-center mb-4">
        <div>
            <h1 class="text-2xl font-semibold">Departments</h1>
        </div>
        <div>
            <a href="{{ route('assign.head') }}" class="bg-green-500 text-white py-2 px-4 my-2 rounded hover:bg-green-600">Assign Head</a>
            <a href="{{ route('departments.create') }}" class="bg-blue-500 text-white py-2 px-4 my-2 rounded hover:bg-blue-600">Create Department</a>
        </div>
    </div>
    @if (count($departments) > 0)
    <div class="overflow-x-auto">
        <table class="min-w-full bg-white border border-gray-300">
            <thead>
                <tr>
                    <th class="py-2 px-4 bg-gray-100">ID</th>
                    <th class="py-2 px-4 bg-gray-100">Name</th>
                    <th class="py-2 px-4 bg-gray-100">Description</th>
                    <th class="py-2 px-4 bg-gray-100">Branch</th>
                    <th class="py-2 px-4 bg-gray-100">Head</th>
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
                        @if ($department->departmentHead)
                            {{ $department->departmentHead->name }}
                        @else
                            Not Assigned
                        @endif
                    </td>
                    <td class="py-2 px-4 text-center">
                        <a href="{{ route('departments.show', $department->id) }}" class="text-blue-500 hover:underline mr-2"><i class="fa-solid fa-eye"></i></a>
                        <a href="{{ route('departments.edit', $department->id) }}" class="text-yellow-500 mr-2 hover:underline"><i class="fa-solid fa-pen-to-square"></i></a>
                        <form class="inline-block" action="{{ route('departments.destroy', $department->id) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="text-red-500 hover:underline" onclick="return confirm('Are you sure?')"><i class="fa-solid fa-trash"></i></button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    @else
    <p class="mt-4">No departments found.</p>
    @endif
</div>
@endsection
