@extends('layouts.app')
@section('content')
    <div class="flex justify-center items-center h-screen">
        <form action="{{ route('grade.store') }}" method="post" class="bg-white shadow-md rounded px-8 pt-6 pb-8 mb-4 w-full sm:w-1/2 lg:w-1/3 mx-auto">
            @csrf
            <div class="mb-4">
                <label for="grade_name" class="block text-gray-700 text-sm font-bold mb-2">Grade Name:</label>
                <input type="text" name="grade_name" class="appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" required>
            </div>
            <div class="flex items-center justify-between">
                <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline" type="button">Create Grade</button>
            </div>
        </form>
    </div>
@endsection
