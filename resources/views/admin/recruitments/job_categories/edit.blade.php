@extends('layouts.app')

@section('content')
    <div class="container mx-auto py-8">
        <div class="max-w-md mx-auto bg-white p-6 rounded-lg shadow-lg">
            <h2 class="text-2xl font-bold mb-4">Edit Job Category</h2>

            <form action="{{ route('job_categories.update', $jobCategory->id) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="mb-4">
                    <label for="name" class="block text-gray-700 text-sm font-bold mb-2">Name:</label>
                    <input type="text" name="name" id="name" value="{{ $jobCategory->name }}" class="border rounded p-2 w-full" required>
                </div>

                <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                    Update Job Category
                </button>
                <a href="{{ route('job_categories.index') }}" class="bg-gray-300 hover:bg-gray-400 text-gray-800 font-bold py-2 px-4 rounded ml-2">
                    Cancel
                </a>
            </form>
        </div>
    </div>
@endsection
