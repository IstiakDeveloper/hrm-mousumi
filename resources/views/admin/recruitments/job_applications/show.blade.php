@extends('layouts.app')

@section('content')
    <div class="container mx-auto mt-8">
        <div class="bg-white p-8 rounded-lg shadow-lg">
            <div class="flex justify-between">
                <div class="title">
                    <h1 class="text-2xl font-bold mb-4">Job Application</h1>
                </div>
                <div>
                    <a href="{{ route('admin.jobApplications.downloadPDF', ['id' => $jobApplication->id]) }}" class="bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">Download as PDF</a>
                </div>
            </div>


            <div class="flex flex-col items-center">
                <div class="mb-4">
                    @if ($jobApplication->profile_image)
                        <img src="{{ asset('storage/' . $jobApplication->profile_image) }}" alt="Profile Image" class="w-32 h-32 object-cover rounded-full">
                    @else
                        <span>No profile image provided</span>
                    @endif
                </div>

                <div class="mb-4">
                    @if ($jobApplication->resume)
                        <a href="{{ asset('storage/' . $jobApplication->resume) }}" target="_blank" class="text-blue-500 hover:underline">Download Resume</a>
                    @else
                        <span>No resume provided</span>
                    @endif
                </div>
            </div>

            <div class="mt-6 text-center">
                <div class="mb-4">
                    <label class="block font-semibold">Name:</label>
                    <span>{{ $jobApplication->name }}</span>
                </div>

                <div class="mb-4">
                    <label class="block font-semibold">Email:</label>
                    <span>{{ $jobApplication->email }}</span>
                </div>

                <div class="mb-4">
                    <label class="block font-semibold ">Phone:</label>
                    <span>{{ $jobApplication->phone }}</span>
                </div>

                <div class="mb-4">
                    <label class="block font-semibold">Date of Birth:</label>
                    <span>{{ $jobApplication->date_of_birth }}</span>
                </div>

                <div class="mb-4">
                    <label class="block font-semibold">Address:</label>
                    <span>{{ $jobApplication->address }}</span>
                </div>

                <div class="mb-4">
                    <label class="block font-semibold">Cover Letter:</label>
                    <p>{{ $jobApplication->cover_letter }}</p>
                </div>
            </div>

            <div class="mt-6">
                <a href="{{ route('admin.jobApplications') }}" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">Back to Applications</a>
            </div>


        </div>
    </div>
@endsection
