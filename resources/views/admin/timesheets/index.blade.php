@extends('layouts.app')

@section('content')
<div class="container mx-auto p-4">
    <h1 class="text-2xl mb-4">Timesheets</h1>

    <a href="{{ route('timesheets.create') }}" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded mb-4">Create Timesheet Entry</a>

    <table class="min-w-full bg-white border border-gray-300">
        <thead>
            <tr>
                <th class="py-2 px-4">Date</th>
                <th class="py-2 px-4">Clock In</th>
                <th class="py-2 px-4">Clock Out</th>
                <th class="py-2 px-4">Worked Hours</th>
                <th class="py-2 px-4">Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($timesheets as $timesheet)
                <tr>
                    <td class="py-2 px-4">{{ $timesheet->date }}</td>
                    <td class="py-2 px-4">{{ $timesheet->clock_in }}</td>
                    <td class="py-2 px-4">{{ $timesheet->clock_out }}</td>
                    <td class="py-2 px-4">{{ $timesheet->hours_worked }}</td>
                    <td class="py-2 px-4">
                        <a href="{{ route('timesheets.show', $timesheet->id) }}" class="text-blue-500 hover:underline">View</a>
                        <a href="{{ route('timesheets.edit', $timesheet->id) }}" class="text-green-500 hover:underline ml-2">Edit</a>
                        <form action="{{ route('timesheets.destroy', $timesheet->id) }}" method="POST" class="inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="text-red-500 hover:underline ml-2">Delete</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
