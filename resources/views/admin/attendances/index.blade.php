@extends('layouts.app')

@section('content')
<div class="container mx-auto p-4">
    <div class="flex justify-between items-center mb-4">
        <h1 class="text-2xl mb-4">Attendance Records</h1>
        <a href="{{ route('attendances.create') }}" class="bg-blue-500 text-white py-2 px-4 my-2 rounded hover:bg-blue-600">Create Attendance</a>
    </div>

    <div class="overflow-x-auto">
        <table class="min-w-full bg-white border border-gray-300">
            <thead>
                <tr>
                    <th class="py-2 px-4 border-b">Employee Name</th>
                    <th class="py-2 px-4 border-b">Date</th>
                    <th class="py-2 px-4 border-b">Status</th>
                    <th class="py-2 px-4 border-b">Clock In</th>
                    <th class="py-2 px-4 border-b">Clock Out</th>
                    <th class="py-2 px-4 border-b">Late Minutes</th>
                    <th class="py-2 px-4 border-b">Early Leaving Minutes</th>
                    <th class="py-2 px-4 border-b">Overtime Minutes</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-200">
                @foreach ($attendances as $attendance)
                <tr>
                    <td class="py-2 px-4 border-b">{{ $attendance->employee->name }}</td>
                    <td class="py-2 px-4 border-b">{{ $attendance->date }}</td>
                    <td class="py-2 px-4 border-b">{{ $attendance->status }}</td>
                    <td class="py-2 px-4 border-b">{{ $attendance->clock_in }}</td>
                    <td class="py-2 px-4 border-b">{{ $attendance->clock_out }}</td>
                    <td class="py-2 px-4 border-b">{{ $attendance->late_minutes }}</td>
                    <td class="py-2 px-4 border-b">{{ $attendance->early_leaving_minutes }}</td>
                    <td class="py-2 px-4 border-b">{{ $attendance->overtime_minutes }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection
