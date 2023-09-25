@extends('layouts.app')

@section('content')
<div class="container mx-auto p-4">
    <h1 class="text-2xl mb-4">Leave Types</h1>
    <a href="{{ route('leave_types.create') }}" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded mb-4">Create Leave Type</a>

    <table class="min-w-full border mt-4">
        <thead>
            <tr>
                <th class="border-b">ID</th>
                <th class="border-b">Leave Type</th>
                <th class="border-b">Days/Year</th>
                <th class="border-b">Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($leaveTypes as $leaveType)
                <tr>
                    <td class="border text-center">{{ $leaveType->id }}</td>
                    <td class="border text-center">{{ $leaveType->leave_type }}</td>
                    <td class="border text-center">{{ $leaveType->day }}</td>
                    <td class="border text-center">
                        <a href="{{ route('leave_types.show', $leaveType->id) }}" class="text-blue-500">View</a>
                        <a href="{{ route('leave_types.edit', $leaveType->id) }}" class="text-yellow-500 ml-2">Edit</a>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
