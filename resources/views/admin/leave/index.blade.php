@extends('layouts.app')

@section('content')
    <div class="container mx-auto p-4">
        <div class="flex justify-between items-center mb-4">
            <h1 class="text-2xl font-semibold">Leave Applications</h1>
            <div>
                <a href="{{ route('leave.create') }}" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded mb-4">Apply for Leave</a>
            </div>
        </div>

        <div class="overflow-x-auto">
            <table class="min-w-full bg-white border border-gray-300">
                <thead>
                    <tr>
                        <th class="py-2 px-4 bg-gray-100">SL</th>
                        <th class="py-2 px-4 bg-gray-100">Employee</th>
                        <th class="py-2 px-4 bg-gray-100">Leave Type</th>
                        <th class="py-2 px-4 bg-gray-100">Applied On</th>
                        <th class="py-2 px-4 bg-gray-100">Start Date</th>
                        <th class="py-2 px-4 bg-gray-100">End Date</th>
                        <th class="py-2 px-4 bg-gray-100">Total Days</th>
                        <th class="py-2 px-4 bg-gray-100">Leave Reason</th>
                        <th class="py-2 px-4 bg-gray-100">Status</th>
                        <th class="py-2 px-4 bg-gray-100">Actions</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-200">
                    @foreach ($leaves as $key => $leave)
                        <tr>
                            <td class="py-2 px-4 text-center">{{ $kay+1}}</td>
                            <td class="py-2 px-4 text-center">{{ $leave->employee->name }}</td>
                            <td class="py-2 px-4 text-center">{{ $leave->leaveType->leave_type }}</td>
                            <td class="py-2 px-4 text-center">{{ $leave->applied_on }}</td>
                            <td class="py-2 px-4 text-center">{{ $leave->start_date }}</td>
                            <td class="py-2 px-4 text-center">{{ $leave->end_date }}</td>
                            <td class="py-2 px-4 text-center">{{ $leave->total_days }}</td>
                            <td class="py-2 px-4 text-center">{{ $leave->leave_reason }}</td>
                            <td class="py-2 px-4 text-center">{{ $leave->status }}</td>
                            <td class="py-2 px-4 text-center">
                                <a href="{{ route('leave.show', $leave->id) }}" class="text-blue-500 hover:underline mr-2"><i class="fa-solid fa-eye"></i></a>
                                <a href="{{ route('leave.edit', $leave->id) }}" class="text-yellow-500 hover:underline"><i class="fa-solid fa-pen-to-square"></i></a>
                                <form class="inline-block" action="{{ route('leave.destroy', $leave) }}" method="POST">
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
    </div>
@endsection
