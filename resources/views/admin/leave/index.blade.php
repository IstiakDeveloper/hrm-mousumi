@extends('layouts.app')

@section('content')
    <div class="container mx-auto p-4">
        <h1 class="text-2xl mb-4">Leave Applications</h1>
        <a href="{{ route('leave.create') }}" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded mb-4">Apply for Leave</a>

        <table class="min-w-full border mt-4">
            <thead>
                <tr>
                    <th class="border-b">ID</th>
                    <th class="border-b">Employee</th>
                    <th class="border-b">Leave Type</th>
                    <th class="border-b">Applied On</th>
                    <th class="border-b">Start Date</th>
                    <th class="border-b">End Date</th>
                    <th class="border-b">Total Days</th>
                    <th class="border-b">Leave Reason</th>
                    <th class="border-b">Status</th>
                    <th class="border-b">Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($leaves as $leave)
                    <tr>
                        <td class="border text-center">{{ $leave->id }}</td>
                        <td class="border text-center">{{ $leave->employee->name }}</td>
                        <td class="border text-center">{{ $leave->leaveType->leave_type }}</td>
                        <td class="border text-center">{{ $leave->applied_on }}</td>
                        <td class="border text-center">{{ $leave->start_date }}</td>
                        <td class="border text-center">{{ $leave->end_date }}</td>
                        <td class="border text-center">{{ $leave->total_days }}</td>
                        <td class="border text-center">{{ $leave->leave_reason }}</td>
                        <td class="border text-center">{{ $leave->status }}</td>
                        <td class="border text-center">
                            <a href="{{ route('leave.show', $leave->id) }}" class="text-blue-500">View</a>
                            <a href="{{ route('leave.edit', $leave->id) }}" class="text-yellow-500 ml-2">Edit</a>
                            <form class="inline-block" action="{{ route('leave.destroy', $leave) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="text-red-500 hover:underline" onclick="return confirm('Are you sure?')">Delete</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
