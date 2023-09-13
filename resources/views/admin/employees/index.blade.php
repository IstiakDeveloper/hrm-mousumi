@extends('layouts.app')

@section('content')
<div class="container mx-auto py-4">
    <div class="flex justify-between items-center mb-4">
        <h1 class="text-2xl font-semibold">Employees</h1>
        <div>
            <a href="{{ route('employees.create') }}" class="bg-blue-500 text-white py-2 px-4 rounded hover:bg-blue-600">Create Employee</a>
        </div>
    </div>
    @if (count($employees) > 0)
    <table class="min-w-full">
        <thead>
            <tr>
                <th class="py-2 px-4 bg-gray-100">Employee ID</th>
                <th class="py-2 px-4 bg-gray-100">Name</th>
                <th class="py-2 px-4 bg-gray-100">Email</th>
                <th class="py-2 px-4 bg-gray-100">Branch</th>
                <th class="py-2 px-4 bg-gray-100">Department</th>
                <th class="py-2 px-4 bg-gray-100">Designation</th>
                <th class="py-2 px-4 bg-gray-100">Date of Joining</th>
                <th class="py-2 px-4 bg-gray-100">Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($employees as $employee)
            <tr>
                <td class="py-2 px-4 text-center">{{ $employee->employee_id }}</td>
                <td class="py-2 px-4 text-center">{{ $employee->name }}</td>
                <td class="py-2 px-4 text-center">{{ $employee->email }}</td>
                <td class="py-2 px-4 text-center">{{ $employee->branch->name }}</td>
                <td class="py-2 px-4 text-center">{{ $employee->department->name }}</td>
                <td class="py-2 px-4 text-center">{{ $employee->designation->name }}</td>
                <td class="py-2 px-4 text-center">{{ $employee->date_of_joining}}</td>
                <td class="py-2 px-4 text-center">
                    <a href="{{ route('employees.show', $employee) }}" class="text-blue-500 hover:underline">View</a>
                    <a href="{{ route('employees.edit', $employee) }}" class="text-yellow-500 hover:underline">Edit</a>
                    <form class="inline-block" action="{{ route('employees.destroy', $employee) }}" method="POST">
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
    <p class="mt-4">No employees found.</p>
    @endif
</div>
@endsection
