@extends('layouts.app')

@section('content')
<div class="container mx-auto p-4">
    <div class="flex justify-between items-center mb-4">
        <h1 class="text-2xl font-semibold">Timesheets</h1>
        @if (Auth::user()->permissions()->contains('timesheet.create'))
        <div>
            <a href="{{ route('timesheets.create') }}" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded mb-4">Create Timesheet Entry</a>
        </div>
        @endif
    </div>
    <table class="min-w-full bg-white border border-gray-300 mt-4">
        <thead>
            <tr>
                <th class="py-2 px-4 bg-gray-100">ID</th>
                <th class="py-2 px-4 bg-gray-100">Employee</th>
                <th class="py-2 px-4 bg-gray-100">Date</th>
                <th class="py-2 px-4 bg-gray-100">Office Start</th>
                <th class="py-2 px-4 bg-gray-100">Office End</th>
                <th class="py-2 px-4 bg-gray-100">Hours Worked</th>
                <th class="py-2 px-4 bg-gray-100">Remark</th>
                <th class="py-2 px-4 bg-gray-100">Actions</th>
            </tr>
        </thead>
        <tbody class="divide-y divide-gray-200">
            @foreach ($timesheets as $timesheet)
                <tr>
                    <td class="py-2 px-4 text-center">{{ $timesheet->id }}</td>
                    <td class="py-2 px-4 text-center">{{ $timesheet->employee->name }}</td>
                    <td class="py-2 px-4 text-center">{{ $timesheet->date }}</td>
                    <td class="py-2 px-4 text-center">{{ $timesheet->office_start }}</td>
                    <td class="py-2 px-4 text-center">{{ $timesheet->office_end }}</td>
                    <td class="py-2 px-4 text-center">{{ $timesheet->hours_worked }}</td>
                    <td class="py-2 px-4 text-center">{{ $timesheet->remark }}</td>
                    <td class="py-2 px-4 text-center">
                        <a href="{{ route('timesheets.edit', $timesheet->id) }}" class="text-yellow-500 mr-2 hover:underline"><i class="fa-solid fa-pen-to-square"></i></a>
                        <form class="inline-block" action="{{ route('timesheets.destroy', $timesheet) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="text-red-500 hover:underline" onclick="return confirm('Are you sure?')"><i class="fa-solid fa-trash"></i></button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
