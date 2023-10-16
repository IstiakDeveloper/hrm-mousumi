@extends('layouts.app')

@section('content')
    <div class="container mx-auto py-8">
        <div class="flex justify-between items-center mb-4">
            <h2 class="text-2xl font-bold">Job Categories</h2>
            <a href="{{ route('job_categories.create') }}" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                Create Job Category
            </a>
        </div>


        @if (session('success'))
            <div class="bg-green-100 border-l-4 border-green-500 text-green-700 p-4 mb-4" role="alert">
                <p>{{ session('success') }}</p>
            </div>
        @endif

        <table class="min-w-full bg-white border border-gray-300">
            <thead>
                <tr>
                    <th class="py-2 px-4 border-b">ID</th>
                    <th class="py-2 px-4 border-b">Name</th>
                    <th class="py-2 px-4 border-b">Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($jobCategories as $key => $jobCategory)
                    <tr>
                        <td class="py-2 px-4 text-center border-b">{{ $key+1 }}</td>
                        <td class="py-2 px-4 text-center border-b">{{ $jobCategory->name }}</td>
                        <td class="py-2 px-4 text-center border-b">
                            <a href="{{ route('job_categories.edit', $jobCategory->id) }}" class="text-blue-600 hover:underline mr-2">
                                Edit
                            </a>
                            <form action="{{ route('job_categories.destroy', $jobCategory->id) }}" method="POST" class="inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="text-red-600 hover:underline" onclick="return confirm('Are you sure you want to delete this job category?')">
                                    Delete
                                </button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="3" class="py-4 px-4 border-b text-center">No job categories found.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
@endsection
