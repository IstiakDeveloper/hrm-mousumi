@extends('layouts.app')

@section('content')
<div class="container mx-auto p-4">
    <h1 class="text-2xl mb-4">Edit Timesheet Entry</h1>
    <form action="{{ route('timesheets.update', $timesheet->id) }}" method="POST" class="max-w-md">
        @csrf
        @method('PUT')
        <div class="mb-4">
            <label for="employee_id" class="block text-gray-700 text-sm font-bold mb-2">Employee:</label>
            <select name="employee_id" id="employee_id" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                @foreach ($employees as $employee)
                <option value="{{ $employee->id }}" {{ $employee->id == $timesheet->employee_id ? 'selected' : '' }}>
                    {{ $employee->name }}
                </option>
                @endforeach
            </select>
        </div>
        <div class="mb-4">
            <label for="date" class="block text-gray-700 text-sm font-bold mb-2">Date:</label>
            <input type="date" name="date" id="date" value="{{ $timesheet->date }}" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
        </div>
        <!-- Add other input fields for timesheet attributes -->
        <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">Update</button>
    </form>
</div>
@endsection
