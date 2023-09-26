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
                    <option value="{{ $employee->id }}" {{ $timesheet->employee_id == $employee->id ? 'selected' : '' }}>
                        {{ $employee->name }}
                    </option>
                @endforeach
            </select>
            @error('employee_id')
                <p class="text-red-500 text-xs italic">{{ $message }}</p>
            @enderror
        </div>

        <!-- Date -->
        <div class="mb-4">
            <label for="date" class="block text-gray-700 text-sm font-bold mb-2">Date:</label>
            <input type="date" name="date" id="date" value="{{ $timesheet->date }}" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
            @error('date')
                <p class="text-red-500 text-xs italic">{{ $message }}</p>
            @enderror
        </div>

        <!-- Office Start -->
        <div class="mb-4">
            <label for="office_start" class="block text-gray-700 text-sm font-bold mb-2">Office Start:</label>
            <input type="time" name="office_start" id="office_start" value="{{ $timesheet->office_start }}" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
            @error('office_start')
                <p class="text-red-500 text-xs italic">{{ $message }}</p>
            @enderror
        </div>

        <!-- Office End -->
        <div class="mb-4">
            <label for="office_end" class="block text-gray-700 text-sm font-bold mb-2">Office End:</label>
            <input type="time" name="office_end" id="office_end" value="{{ $timesheet->office_end }}" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
            @error('office_end')
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
            @error('remark')
                <p class="text-red-500 text-xs italic">{{ $message }}</p>
            @enderror
        </div>

        <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">Save Changes</button>
    </form>
</div>
@endsection
