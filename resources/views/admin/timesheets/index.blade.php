@extends('layouts.app')

@section('content')
<div class="container mx-auto p-4">
    <h1 class="text-2xl mb-4">Timesheets</h1>
    <a href="{{ route('timesheets.create') }}" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded mb-4">Create Timesheet Entry</a>

    <table class="min-w-full border mt-4">
        <thead>
            <tr>
                <th class="border-b">ID</th>
                <th class="border-b">Employee</th>
                <th class="border-b">Date</th>
                <th class="border-b">Office Start</th>
                <th class="border-b">Office End</th>
                <th class="border-b">Hours Worked</th>
                <th class="border-b">Remark</th>
                <th class="border-b">Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($timesheets as $timesheet)
                <tr>
                    <td class="border text-center">{{ $timesheet->id }}</td>
                    <td class="border text-center">{{ $timesheet->employee->name }}</td>
                    <td class="border text-center">{{ $timesheet->date }}</td>
                    <td class="border text-center">{{ $timesheet->office_start }}</td>
                    <td class="border text-center">{{ $timesheet->office_end }}</td>
                    <td class="border text-center">{{ $timesheet->hours_worked }}</td>
                    <td class="border text-center">{{ $timesheet->remark }}</td>
                    <td class="border text-center">
                        <a href="{{ route('timesheets.edit', $timesheet->id) }}" class="text-yellow-500 ml-2">Edit</a>
                        <form class="inline-block" action="{{ route('timesheets.destroy', $timesheet) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="text-red-500 hover:underline" onclick="return confirm('Are you sure?')">Delete</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
