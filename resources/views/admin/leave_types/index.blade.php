@extends('layouts.app')

@section('content')
<div class="container mx-auto p-4">
    <div class="flex justify-between items-center mb-4">
        <h1 class="text-2xl font-semibold">Leave Types</h1>
        <div>
            <a href="{{ route('leave_types.create') }}" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded mb-4">Create Leave Type</a>
        </div>
    </div>
    <div class="overflow-x-auto">
        <table class="min-w-full bg-white border border-gray-300 mt-4">
            <thead>
                <tr>
                    <th class="py-2 px-4 bg-gray-100">SL</th>
                    <th class="py-2 px-4 bg-gray-100">Leave Type</th>
                    <th class="py-2 px-4 bg-gray-100">Days/Year</th>
                    <th class="py-2 px-4 bg-gray-100">Actions</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-200">
                @foreach ($leaveTypes as $key => $leaveType)
                    <tr>
                        <td class="py-2 px-4 text-center">{{ $key+1 }}</td>
                        <td class="py-2 px-4 text-center">{{ $leaveType->leave_type }}</td>
                        <td class="py-2 px-4 text-center">{{ $leaveType->day }}</td>
                        <td class="py-2 px-4 text-center">
                            <a href="{{ route('leave_types.show', $leaveType->id) }}" class="text-blue-500 hover:underline mr-2"><i class="fa-solid fa-eye"></i></a>
                            <a href="{{ route('leave_types.edit', $leaveType->id) }}" class="text-yellow-500 hover:underline"><i class="fa-solid fa-pen-to-square"></i></a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection
