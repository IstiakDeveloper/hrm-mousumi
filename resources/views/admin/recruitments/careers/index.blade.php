@extends('layouts.guest')

@section('content')
    <div class="container mx-auto p-6">
        <h1 class="text-3xl font-bold mb-8">All Jobs</h1>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            @foreach($jobs as $job)
            @if($job->status === 'Active')
                <div class="bg-white rounded-lg p-6 shadow-lg">
                    <div class="flex items-center mb-4">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 mr-2 text-blue-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M15 10.5a3 3 0 11-6 0 3 3 0 016 0z" />
                            <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 10.5c0 7.142-7.5 11.25-7.5 11.25S4.5 17.642 4.5 10.5a7.5 7.5 0 1115 0z" />
                        </svg>
                        <span class="text-blue-500">{{ $job->branch }}</span>
                    </div>
                    <h2 class="text-xl font-bold mt-6 mb-12">{{ $job->title }}</h2>
                    <div class="flex mb-4">
                        <span class="text-gray-700">Positions Available: {{ $job->number_of_positions }}</span>
                    </div>
                    <div class="flex flex-wrap mb-4">
                        @php
                            $skills = explode(',', $job->skills);
                        @endphp
                        @foreach($skills as $skill)
                            <span class="bg-blue-100 text-blue-700 rounded-full py-1 px-4 mr-2 mb-2">{{ $skill }}</span>
                        @endforeach
                    </div>
                    <div class="flex justify-center">
                        <a href="{{ route('jobs.show', $job->id) }}" class="bg-blue-500 text-white hover:bg-blue-700 rounded-full py-2 px-6 text-center inline-block mt-6 block mx-auto">Read More</a>
                    </div>
                </div>
            @endif
        @endforeach
        </div>


    </div>
@endsection
