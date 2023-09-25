@extends('layouts.app')

@section('content')
<div class="container mx-auto p-4">
    <h1 class="text-2xl mb-4">Edit Leave Entry</h1>
    <form action="{{ route('leave.update', $leave->id) }}" method="POST" class="max-w-md">
        @csrf
        @method('PUT')

        <!-- Employee -->
        <div class="mb-4">
            <label for="employee_id" class="block text-gray-700 text-sm font-bold mb-2">Employee:</label>
            <select name="employee_id" id="employee_id" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                @foreach ($employees as $employee)
                    <option value="{{ $employee->id }}" {{ $leave->employee_id == $employee->id ? 'selected' : '' }}>{{ $employee->name }}</option>
                @endforeach
            </select>
            @error('employee_id')
                <p class="text-red-500 text-xs italic">{{ $message }}</p>
            @enderror
        </div>

        <!-- Leave Type -->
        <div class="mb-4">
            <label for="leave_type_id" class="block text-gray-700 text-sm font-bold mb-2">Leave Type:</label>
            <select name="leave_type_id" id="leave_type_id" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                @foreach ($leaveTypes as $type)
                    <option value="{{ $type->id }}" {{ $leave->leave_type_id == $type->id ? 'selected' : '' }}>{{ $type->leave_type }}</option>
                @endforeach
            </select>
            @error('leave_type_id')
                <p class="text-red-500 text-xs italic">{{ $message }}</p>
            @enderror
        </div>

        <!-- Applied On -->
        <div class="mb-4">
            <label for="applied_on" class="block text-gray-700 text-sm font-bold mb-2">Applied On:</label>
            <input type="date" name="applied_on" id="applied_on" value="{{ $leave->applied_on }}" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
            @error('applied_on')
                <p class="text-red-500 text-xs italic">{{ $message }}</p>
            @enderror
        </div>

        <!-- Start Date -->
        <div class="mb-4">
            <label for="start_date" class="block text-gray-700 text-sm font-bold mb-2">Start Date:</label>
            <input type="date" name="start_date" id="start_date" value="{{ $leave->start_date }}" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
            @error('start_date')
                <p class="text-red-500 text-xs italic">{{ $message }}</p>
            @enderror
        </div>

        <!-- End Date -->
        <div class="mb-4">
            <label for="end_date" class="block text-gray-700 text-sm font-bold mb-2">End Date:</label>
            <input type="date" name="end_date" id="end_date" value="{{ $leave->end_date }}" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
            @error('end_date')
                <p class="text-red-500 text-xs italic">{{ $message }}</p>
            @enderror
        </div>

        <!-- Total Days -->
        <div class="mb-4">
            <label for="total_days" class="block text-gray-700 text-sm font-bold mb-2">Total Days:</label>
            <input type="number" name="total_days" id="total_days" value="{{ $leave->total_days }}" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
            @error('total_days')
                <p class="text-red-500 text-xs italic">{{ $message }}</p>
            @enderror
        </div>

        <!-- Leave Reason -->
        <div class="mb-4">
            <label for="leave_reason" class="block text-gray-700 text-sm font-bold mb-2">Leave Reason:</label>
            <textarea name="leave_reason" id="leave_reason" rows="3" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">{{ $leave->leave_reason }}</textarea>
            @error('leave_reason')
                <p class="text-red-500 text-xs italic">{{ $message }}</p>
            @enderror
        </div>

        <!-- Status -->
        <div class="mb-4">
            <label for="status" class="block text-gray-700 text-sm font-bold mb-2">Status:</label>
            <select name="status" id="status" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                <option value="Pending" {{ $leave->status === 'Pending' ? 'selected' : '' }}>Pending</option>
                <option value="Approved" {{ $leave->status === 'Approved' ? 'selected' : '' }}>Approved</option>
                <option value="Rejected" {{ $leave->status === 'Rejected' ? 'selected' : '' }}>Rejected</option>
            </select>
            @error('status')
                <p class="text-red-500 text-xs italic">{{ $message }}</p>
            @enderror
        </div>

        <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">Update</button>
    </form>
</div>
@endsection
