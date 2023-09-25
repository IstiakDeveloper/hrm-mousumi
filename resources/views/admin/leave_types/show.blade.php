@extends('layouts.app')

@section('content')
<div class="container mx-auto p-4">
    <h1 class="text-2xl mb-4">Leave Type Details</h1>
    <div class="mb-4">
        <p><span class="font-bold">ID:</span> {{ $leaveType->id }}</p>
        <p><span class="font-bold">Leave Type:</span> {{ $leaveType->leave_type }}</p>
        <p><span class="font-bold">Days:</span> {{ $leaveType->day }}</p>
    </div>
    <a href="{{ route('leave_types.edit', $leaveType->id) }}" class="bg-yellow-500 hover:bg-yellow-700 text-white font-bold py-2 px-4 mt-4 rounded">Edit</a>
</div>
@endsection
