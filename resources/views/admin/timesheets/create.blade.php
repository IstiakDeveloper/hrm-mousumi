@extends('layouts.app')

@section('content')
<div class="container mx-auto p-4">
    <h1 class="text-2xl mb-4">Create Timesheet Entry</h1>

    <!-- Display Validation Errors -->
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('timesheets.store') }}" method="POST" class="max-w-md">
        @csrf
        <div class="mb-4">
            <label for="employee_id" class="block text-gray-700 text-sm font-bold mb-2">Employee:</label>
            <select name="employee_id" id="employee_id" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                @foreach ($employees as $employee)
                <option value="{{ $employee->id }}">{{ $employee->name }}</option>
                @endforeach
            </select>
        </div>
        <div class="mb-4">
            <label for="date" class="block text-gray-700 text-sm font-bold mb-2">Date:</label>
            <input type="date" name="date" id="date" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
        </div>
        <div class="mb-4">
            <label for="attendance" class="block text-gray-700 text-sm font-bold mb-2">Attendance:</label>
            <select name="attendance" id="attendance" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                <option value="1">Present</option>
                <option value="0">Absent</option>
            </select>
        </div>
        <div class="mb-4">
            <label for="clock_in" class="block text-gray-700 text-sm font-bold mb-2">Clock In (optional):</label>
            <input type="text" name="clock_in" id="clock_in" pattern="\d{2}:\d{2}:\d{2}" placeholder="HH:MM:SS" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
            <small class="text-gray-500">Format: HH:MM:SS</small>
        </div>
        <div class="mb-4">
            <label for="clock_out" class="block text-gray-700 text-sm font-bold mb-2">Clock Out (optional):</label>
            <input type="text" name="clock_out" id="clock_out" pattern="\d{2}:\d{2}:\d{2}" placeholder="HH:MM:SS" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
            <small class="text-gray-500">Format: HH:MM:SS</small>
        </div>

        <div class="mb-4">
            <label for="hours_worked" class="block text-gray-700 text-sm font-bold mb-2">Hours Worked (optional):</label>
            <input type="number" name="hours_worked" id="hours_worked" step="0.01" min="0" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
        </div>
        <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">Submit</button>
    </form>
</div>
@endsection
