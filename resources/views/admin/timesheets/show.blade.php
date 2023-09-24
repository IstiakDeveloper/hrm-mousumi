@extends('layouts.app')

@section('content')
<div class="container mx-auto p-4">
    <h1 class="text-2xl mb-4">Timesheet Entry</h1>
    <div class="mb-4">
        <strong>ID:</strong> {{ $timesheet->id }}
    </div>
    <div class="mb-4">
        <strong>Employee:</strong> {{ $timesheet->employee_id }}
    </div>
    <div class="mb-4">
        <strong>Date:</strong> {{ $timesheet->date }}
    </div>
    <!-- Add other display fields for timesheet attributes -->
</div>
@endsection
