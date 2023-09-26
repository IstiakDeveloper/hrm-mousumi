@extends('layouts.app')

@section('content')
<div class="container mx-auto p-4">
    <h1 class="text-2xl mb-4">Create Timesheet Entry</h1>
    <form action="{{ route('timesheets.store') }}" method="POST" class="max-w-md">
        @csrf

        <!-- Employee -->
        <div class="mb-4">
            <label for="employee_id" class="block text-gray-700 text-sm font-bold mb-2">Employee:</label>
            <select name="employee_id" id="employee_id" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                @foreach ($employees as $employee)
                <option value="{{ $employee->id }}">{{ $employee->name }}</option>
                @endforeach
            </select>
            @error('employee_id')
                <p class="text-red-500 text-xs italic">{{ $message }}</p>
            @enderror
        </div>

        <!-- Date -->
        <div class="mb-4">
            <label for="date" class="block text-gray-700 text-sm font-bold mb-2">Date:</label>
            <input type="date" name="date" id="date" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
            @error('date')
                <p class="text-red-500 text-xs italic">{{ $message }}</p>
            @enderror
        </div>

        <!-- Clock In -->
        <div class="mb-4">
            <label for="office_start" class="block text-gray-700 text-sm font-bold mb-2">Clock In:</label>
            <input type="time" name="office_start" id="office_start" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
        </div>

        <!-- Clock Out -->
        <div class="mb-4">
            <label for="office_end" class="block text-gray-700 text-sm font-bold mb-2">Clock Out:</label>
            <input type="time" name="office_end" id="office_end" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
        </div>

        <!-- Hours Worked -->
        <div class="mb-4">
            <label for="hours_worked" class="block text-gray-700 text-sm font-bold mb-2">Hours Worked:</label>
            <input type="number" name="hours_worked" id="hours_worked" step="0.01" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" disabled>
            @error('hours_worked')
                <p class="text-red-500 text-xs italic">{{ $message }}</p>
            @enderror
        </div>

        <!-- Remark -->
        <div class="mb-4">
            <label for="remark" class="block text-gray-700 text-sm font-bold mb-2">Remark:</label>
            <textarea name="remark" id="remark" rows="3" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"></textarea>
            @error('remark')
                <p class="text-red-500 text-xs italic">{{ $message }}</p>
            @enderror
        </div>

        <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">Submit</button>
    </form>
</div>

<script>
    document.getElementById('office_end').addEventListener('input', function() {
        const clockIn = document.getElementById('office_start').value;
        const clockOut = this.value;

        // Calculate hours worked
        const hoursWorked = calculateHoursWorked(clockIn, clockOut);
        document.getElementById('hours_worked').value = hoursWorked.toFixed(2);
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
