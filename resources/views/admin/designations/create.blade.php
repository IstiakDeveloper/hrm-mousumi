@extends('layouts.app')

@section('content')
<div class="container mx-auto py-4">
    <h1 class="text-2xl font-semibold">Create Designation</h1>
    <form action="{{ route('designations.store') }}" method="POST" class="mt-4">
        @csrf
        <div class="mb-4">
            <label for="department_id" class="block font-medium">Department:</label>
            <select name="department_id" id="department_id" class="border border-gray-300 rounded p-2 w-full" required>
                <option value="">Select Department</option>
                @foreach ($departments as $department)
                    <option value="{{ $department->id }}">{{ $department->name }} - {{ $department->branch->name }}</option>
                @endforeach
            </select>
        </div>
        <div class="mb-4">
            <label for="name" class="block font-medium">Designation Name:</label>
            <input type="text" name="name" id="name" class="border border-gray-300 rounded p-2 w-full" required>
        </div>
        <div class="mb-4">
            <label for="job_description" class="block font-medium">Description:</label>
            <textarea name="job_description" id="job_description" class="border border-gray-300 rounded p-2 w-full" rows="4"></textarea>
        </div>
        <div class="mb-4">
            <label for="salary_grade_id" class="block font-medium">Grade:</label>
            <select name="salary_grade_id" id="salary_grade_id" class="border border-gray-300 rounded p-2 w-full">
                <option value="">Select Grade</option>
                @foreach ($grades as $grade)
                    <option value="{{ $grade->id }}">{{ $grade->grade_name }}</option>
                @endforeach
            </select>
        </div>
        <button type="submit" class="bg-blue-500 text-white py-2 px-4 rounded hover:bg-blue-600">Create Designation</button>
    </form>
    @if ($errors->any())
        <div class="mt-4">
            <div class="text-red-500 text-sm">
                Please correct the following errors:
            </div>
            <ul class="list-disc list-inside">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
</div>
@endsection
