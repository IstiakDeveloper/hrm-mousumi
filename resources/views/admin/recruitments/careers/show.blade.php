@extends('layouts.guest')

@section('content')
    <div class="container mx-auto py-8">
        <div class="mx-auto bg-white p-6 rounded-lg shadow-lg">
            <h1 class="text-2xl font-bold mb-4 text-center">{{ $job->title }}</h1>

            <div class="mb-6">
                <div class="flex justify-between mb-2">
                    <div><strong>Branch:</strong> {{ $job->branch }}</div>
                    <div><strong>Job Category:</strong> {{ $job->job_category_name }}</div>
                </div>
                <div class="flex justify-between mb-2">
                    <div><strong>Number of Positions:</strong> {{ $job->number_of_positions }}</div>
                    <div><strong>Status:</strong> {{ $job->status }}</div>
                </div>
                <div class="flex justify-between mb-2">
                    <div><strong>Start Date:</strong> {{ $job->start_date }}</div>
                    <div><strong>End Date:</strong> {{ $job->end_date }}</div>
                </div>
                <div class="mb-2"><strong>Skills:</strong> {{ $job->skills }}</div>
                <div class="mb-2"><strong>Gender:</strong> {{ $job->gender }}</div>
                <div class="mb-2"><strong>Date of Birth Required:</strong> {{ $job->dob_required ? 'Yes' : 'No' }}</div>
                <div class="mb-2"><strong>Address Required:</strong> {{ $job->address_required ? 'Yes' : 'No' }}</div>
                <div class="mb-2"><strong>Profile Image Required:</strong> {{ $job->profile_image_required ? 'Yes' : 'No' }}</div>
                <div class="mb-2"><strong>Resume Required:</strong> {{ $job->resume_required ? 'Yes' : 'No' }}</div>
                <div class="mb-2"><strong>Cover Letter Required:</strong> {{ $job->cover_letter_required ? 'Yes' : 'No' }}</div>
            </div>

            <div class="mb-6">
                <h2 class="text-lg font-bold mb-2">Description</h2>
                <p>{{ $job->description }}</p>
            </div>

            <div class="mb-6">
                <h2 class="text-lg font-bold mb-2">Requirements</h2>
                <p>{{ $job->requirements }}</p>
            </div>

            <div class="flex justify-center mt-6">
                <a href="{{ route('jobs.applyForm', ['jobId' => $job->id]) }}" class="bg-blue-500 hover:bg-blue-700 text-white rounded-full py-2 px-6 text-center inline-block mr-4">Apply Now</a>
                <a href="{{ route('jobs.index') }}" class="bg-gray-500 hover:bg-gray-700 text-white rounded-full py-2 px-6 text-center inline-block">Back to Jobs</a>
            </div>
        </div>
    </div>
@endsection
