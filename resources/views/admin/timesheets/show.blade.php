@extends('layouts.app')

@section('content')
<div class="container mx-auto p-4">
    <h1 class="text-2xl mb-4">Timesheet Details</h1>
    <p><strong>ID:</strong> {{ $timesheet->id }}</p>
    <p><strong>Employee:</strong> {{ $timesheet->employee->name }}</p>
    <p><strong>Date:</strong> {{ $timesheet->date }}</p>
    <p><strong>Hours Worked:</strong> {{ $timesheet->hours_worked }}</p>
    <p><strong>Remark:</strong> {{ $timesheet->remark ?: 'N/A' }}</p>
    <a href="{{ route('timesheets.index') }}" class="text-blue-500">Back to Timesheets</a>
</div>
@endsection
