@extends('layouts.app')

@section('content')
<div class="container mx-auto p-4">
    <h1 class="text-2xl mb-4">Leave Details</h1>

    <div class="mb-4">
        <strong>Employee:</strong> {{ $leave->employee->name }}
    </div>

    <div class="mb-4">
        <strong>Leave Type:</strong> {{ $leave->leaveType->leave_type }}
    </div>

    <div class="mb-4">
        <strong>Applied On:</strong> {{ $leave->applied_on }}
    </div>

    <div class="mb-4">
        <strong>Start Date:</strong> {{ $leave->start_date }}
    </div>

    <div class="mb-4">
        <strong>End Date:</strong> {{ $leave->end_date }}
    </div>

    <div class="mb-4">
        <strong>Total Days:</strong> {{ $leave->total_days }}
    </div>

    <div class="mb-4">
        <strong>Leave Reason:</strong> {{ $leave->leave_reason }}
    </div>

    <div class="mb-4">
        <strong>Status:</strong> {{ $leave->status }}
    </div>

    <a href="{{ route('leave.edit', $leave->id) }}" class="bg-yellow-500 hover:bg-yellow-700 text-white font-bold py-2 px-4 rounded">Edit</a>

    <form action="{{ route('leave.destroy', $leave->id) }}" method="POST" class="inline-block">
        @csrf
        @method('DELETE')
        <button type="submit" class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded">Delete</button>
    </form>
</div>
@endsection
