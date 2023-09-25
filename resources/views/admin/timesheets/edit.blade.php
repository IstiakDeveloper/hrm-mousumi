@extends('layouts.app')

@section('content')
<div class="container mx-auto p-4">
    <h1 class="text-2xl mb-4">Edit Timesheet Entry</h1>
    <form action="{{ route('timesheets.update', $timesheet->id) }}" method="POST" class="max-w-md">
        @csrf
        @method('PUT')

        <!-- Employee -->
        <div class="mb-4">
            <label for="employee_id" class="block text-gray-700 text-sm font-bold mb-2">Employee:</label>
            <select name="employee_id" id="employee_id" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                @foreach ($employees as $employee)
                <option value="{{ $employee->id }}" {{ $timesheet->employee_id == $employee->id ? 'selected' : '' }}>{{ $employee->name }}</option>
                @endforeach
            </select>
        </div>

        <!-- Date -->
        <div class="mb-4">
            <label for="date" class="block text-gray-700 text-sm font-bold mb-2">Date:</label>
            <input type="date" name="date" id="date" value="{{ $timesheet->date }}" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
        </div>

        <!-- Clock In -->
        <div class="mb-4">
            <label for="clock_in" class="block text-gray-700 text-sm font-bold mb-2">Clock In:</label>
            <input type="time" name="clock_in" id="clock_in" value="{{ $timesheet->clock_in }}" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
            @error('clock_in')
                <p class="text-red-500 text-xs italic">{{ $message }}</p>
            @enderror
        </div>

        <!-- Clock Out -->
        <div class="mb-4">
            <label for="clock_out" class="block text-gray-700 text-sm font-bold mb-2">Clock Out:</label>
            <input type="time" name="clock_out" id="clock_out" value="{{ $timesheet->clock_out }}" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
            @error('clock_out')
                <p class="text-red-500 text-xs italic">{{ $message }}</p>
            @enderror
        </div>

        <!-- Hours Worked -->
        <div class="mb-4">
            <label for="hours_worked" class="block text-gray-700 text-sm font-bold mb-2">Hours Worked:</label>
            <input type="number" name="hours_worked" id="hours_worked" step="0.01" value="{{ $timesheet->hours_worked }}" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
            @error('hours_worked')
                <p class="text-red-500 text-xs italic">{{ $message }}</p>
            @enderror
        </div>

        <!-- Remark -->
        <div class="mb-4">
            <label for="remark" class="block text-gray-700 text-sm font-bold mb-2">Remark:</label>
            <textarea name="remark" id="remark" rows="3" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">{{ $timesheet->remark }}</textarea>
        </div>

        <!-- Submit Button -->
        <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">Update</button>
    </form>
</div>

<script>
    document.getElementById('clock_out').addEventListener('change', function() {
        const clockIn = document.getElementById('clock_in').value;
        const clockOut = this.value;

        // Calculate hours worked
        const hoursWorked = calculateHoursWorked(clockIn, clockOut);

        // Set the calculated hours worked in the input field
        document.getElementById('hours_worked').value = hoursWorked;
    });

    function calculateHoursWorked(clockIn, clockOut) {
        const [hoursIn, minutesIn] = clockIn.split(':');
        const [hoursOut, minutesOut] = clockOut.split(':');

        // Calculate the difference in hours
        let hours = hoursOut - hoursIn;
        let minutes = minutesOut - minutesIn;

        // Convert negative minutes to negative hours
        if (minutes < 0) {
            hours--;
            minutes += 60;
        }

        // Calculate the final hours worked
        const hoursWorked = hours + minutes / 60;
        return hoursWorked.toFixed(2);
    }
</script>
@endsection
