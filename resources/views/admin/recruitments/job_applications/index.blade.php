@extends('layouts.app')

@section('content')
    <div class="container mx-auto py-8">
        <h1 class="text-2xl font-bold mb-4">Job Applications <span class="bg-blue-500 text-gray-50 rounded py-2 px-4">{{ count($jobApplications) }}</span></h1>
        <table class="min-w-full bg-white border border-gray-300">
            <thead>
                <tr>
                    <th class="py-2 px-4 border-b">Name</th>
                    <th class="py-2 px-4 border-b">Email</th>
                    <th class="py-2 px-4 border-b">Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($jobApplications as $application)
                    <tr>
                        <td class="py-2 px-4 text-center border-b">{{ $application->name }}</td>
                        <td class="py-2 px-4 text-center border-b">{{ $application->email }}</td>
                        <td class="py-2 px-4 text-center border-b">
                            {{-- Add any actions you want --}}
                            <a href="{{ route('admin.jobApplications.show', ['id' => $application->id]) }}" class="text-blue-500 mr-2" title="Show">
                                <i class="fas fa-eye"></i>
                            </a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
