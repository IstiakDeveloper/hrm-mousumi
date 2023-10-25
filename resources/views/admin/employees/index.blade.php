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
    <div class="overflow-x-auto">
        <table class="min-w-full bg-white border border-gray-300">
          <thead>
            <tr>
              <th class="py-2 px-4 bg-gray-100 hidden md:table-cell">Employee ID</th>
              <th class="py-2 px-4 bg-gray-100">Name</th>
              <th class="py-2 px-4 bg-gray-100 hidden md:table-cell">Email</th>
              <th class="py-2 px-4 bg-gray-100 hidden md:table-cell">Branch</th>
              <th class="py-2 px-4 bg-gray-100 hidden md:table-cell">Department</th>
              <th class="py-2 px-4 bg-gray-100 hidden md:table-cell">Designation</th>
              <th class="py-2 px-4 bg-gray-100 hidden md:table-cell">Date of Joining</th>
              <th class="py-2 px-4 bg-gray-100">Available Leave</th>
              <th class="py-2 px-4 bg-gray-100">Actions</th>
            </tr>
          </thead>
          <tbody class="divide-y divide-gray-200">
            @foreach ($employees as $employee)
            <tr>
              <td class="py-2 px-4 text-center hidden md:table-cell">{{ $employee->employee_id }}</td>
              <td class="py-2 px-4 text-center">{{ $employee->name }}</td>
              <td class="py-2 px-4 text-center hidden md:table-cell">{{ $employee->email }}</td>
              <td class="py-2 px-4 text-center hidden md:table-cell">{{ $employee->branch->name }}</td>
              <td class="py-2 px-4 text-center hidden md:table-cell">{{ $employee->department->name }}</td>
              <td class="py-2 px-4 text-center hidden md:table-cell">{{ $employee->designation->name }}</td>
              <td class="py-2 px-4 text-center hidden md:table-cell">{{ $employee->date_of_joining}}</td>
              <td class="py-2 px-4 text-center">
                <ul>
                  @foreach ($employee->getAvailableLeaveDays() as $leaveTypeId => $availableDays)
                  <li>{{ $leaveTypeId }}: {{ $availableDays }} days</li>
                  @endforeach
                </ul>
              </td>
              <td class="py-2 px-4 text-center">
                <a href="{{ route('employees.show', $employee) }}" class="text-blue-500 hover:underline mr-2"><i class="fa-solid fa-eye"></i></a>
                <a href="{{ route('employees.edit', $employee) }}" class="text-yellow-500 mr-2 hover:underline"><i class="fa-solid fa-pen-to-square"></i></a>
                <a href="{{ route('employees.transfer', $employee) }}" class="text-red-500 mr-2 hover:underline">
                    <i class="fa-solid fa-right-left"></i>
                </a>
                <form class="inline-block" action="{{ route('employees.destroy', $employee) }}" method="POST">
                  @csrf
                  @method('DELETE')
                  <button type="submit" class="ml-2 text-red-500 hover:underline" onclick="return confirm('Are you sure?')"><i class="fa-solid fa-trash"></i></button>
                </form>
              </td>
            </tr>
            @endforeach
          </tbody>
        </table>
      </div>
    @else
    <p class="mt-4">No employees found.</p>
    @endif
</div>
@endsection
