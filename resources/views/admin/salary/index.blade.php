@extends('layouts.app')

@section('content')
    <div class="container mx-auto mt-10">
        <h2 class="text-2xl font-semibold mb-4">Salary Grades</h2>

        <a href="{{ route('grade.create') }}" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded mb-4 inline-block">Create Grade</a>

        @if (count($grades) > 0)
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4">
                @foreach ($grades as $grade)
                    <div class="bg-white p-4 rounded shadow">
                        <h3 class="text-lg font-semibold mb-2">{{ $grade->grade_name }}</h3>
                        <p class="mb-2">Total Steps: {{ count($grade->steps) }}</p>

                        <a href="{{ route('grade.show', ['grade' => $grade->id]) }}" class="bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded mt-2 inline-block">Show</a>
                    </div>
                @endforeach
            </div>
        @else
            <p>No salary grades found.</p>
        @endif
    </div>
@endsection
