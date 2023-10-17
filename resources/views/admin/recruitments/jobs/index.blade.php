@extends('layouts.app')

@section('content')
<div class="container mx-auto py-8">
    <div class="flex justify-between items-center mb-4">
        <h1 class="text-2xl font-bold mb-4">Job Listings</h1>

        <a href="{{ route('jobs.create') }}" class="bg-blue-500 text-white py-2 px-4 rounded mb-4 hover:bg-blue-700">Create Job</a>
    </div>
    <table class="min-w-full bg-white border border-gray-300">
        <thead>
            <tr>
                <th class="py-2 px-4 border-b">Title</th>
                <th class="py-2 px-4 border-b">Branch</th>
                <th class="py-2 px-4 border-b">Status</th>
                <th class="py-2 px-4 border-b">Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($jobs as $job)
                <tr>
                    <td class="py-2 px-4 text-center border-b">{{ $job->title }}</td>
                    <td class="py-2 px-4 text-center border-b">{{ $job->branch }}</td>
                    <td class="py-2 px-4 text-center border-b">{{ $job->status }}</td>
                    <td class="py-2 px-4 text-center border-b">
                        <a href="{{ route('jobs.edit', $job->id) }}" class="text-blue-500 mr-2" title="Edit">
                            <i class="fas fa-edit"></i>
                        </a>
                        <form action="{{ route('jobs.destroy', $job->id) }}" method="POST" class="inline-block">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="text-red-500" title="Delete" onclick="return confirm('Are you sure you want to delete this job?')">
                                <i class="fas fa-trash"></i>
                            </button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
