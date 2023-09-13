@extends('layouts.app')

@section('content')
<div class="container mx-auto py-4">
    <h1 class="text-2xl font-semibold mb-6">Employee Profile</h1>
    <div class="bg-white p-4 rounded-lg shadow mb-6">
        <h2 class="text-xl font-semibold mb-4">Personal Information</h2>
        <!-- Name -->
        <div class="mb-4">
            <label class="block font-medium">Name:</label>
            <p>{{ $employee->name }}</p>
        </div>
        <!-- Phone -->
        <div class="mb-4">
            <label class="block font-medium">Phone:</label>
            <p>{{ $employee->phone }}</p>
        </div>
        <!-- Date of Birth -->
        <div class="mb-4">
            <label class="block font-medium">Date of Birth:</label>
            <p>{{ $employee->date_of_birth }}</p>
        </div>
        <!-- Gender -->
        <div class="mb-4">
            <label class="block font-medium">Gender:</label>
            <p>{{ $employee->gender }}</p>
        </div>
        <!-- Email -->
        <div class="mb-4">
            <label class="block font-medium">Email:</label>
            <p>{{ $employee->email }}</p>
        </div>
        <!-- Address -->
        <div class="mb-4">
            <label class="block font-medium">Address:</label>
            <p>{{ $employee->address }}</p>
        </div>
    </div>

    <div class="bg-white p-4 rounded-lg shadow mb-6">
        <h2 class="text-xl font-semibold mb-4">Company Information</h2>
        <!-- Employee ID -->
        <div class="mb-4">
            <label class="block font-medium">Employee ID:</label>
            <p>{{ $employee->employee_id }}</p>
        </div>
        <!-- Branch -->
        <div class="mb-4">
            <label class="block font-medium">Branch:</label>
            <p>{{ $employee->branch->name }}</p>
        </div>
        <!-- Department -->
        <div class="mb-4">
            <label class="block font-medium">Department:</label>
            <p>{{ $employee->department->name }}</p>
        </div>
        <!-- Designation -->
        <div class="mb-4">
            <label class="block font-medium">Designation:</label>
            <p>{{ $employee->designation->name }}</p>
        </div>
        <!-- Date of Joining -->
        <div class="mb-4">
            <label class="block font-medium">Date of Joining:</label>
            <p>{{ $employee->date_of_joining }}</p>
        </div>
    </div>

    <div class="bg-white p-4 rounded-lg shadow mb-6">
        <h2 class="text-xl font-semibold mb-4">Document</h2>
        <!-- Certificate -->
        <div class="mb-4">
            <label class="block font-medium">Certificate:</label>
            @if ($employee->certificate)
                <a href="{{ asset('storage/' . $employee->certificate) }}" target="_blank" class="text-blue-500 hover:underline">View Certificate</a>
            @else
                <p>No certificate uploaded</p>
            @endif
        </div>
        <!-- Resume -->
        <div class="mb-4">
            <label class="block font-medium">Resume:</label>
            @if ($employee->resume)
                <a href="{{ asset('storage/' . $employee->resume) }}" target="_blank" class="text-blue-500 hover:underline">View Resume</a>
            @else
                <p>No resume uploaded</p>
            @endif
        </div>
        <!-- Photo -->
        <div class="mb-4">
            <label class="block font-medium">Photo:</label>
            @if ($employee->photo)
                <img src="{{ asset('storage/' . $employee->photo) }}" alt="Employee Photo" class="w-32 h-32 rounded-full">
            @else
                <p>No photo uploaded</p>
            @endif
        </div>
    </div>

    <div class="bg-white p-4 rounded-lg shadow mb-6">
        <h2 class="text-xl font-semibold mb-4">Bank Details</h2>
        <!-- Account Holder Name -->
        <div class="mb-4">
            <label class="block font-medium">Account Holder Name:</label>
            <p>{{ $employee->account_holder_name ?? 'Not provided' }}</p>
        </div>
        <!-- Account Number -->
        <div class="mb-4">
            <label class="block font-medium">Account Number:</label>
            <p>{{ $employee->account_number ?? 'Not provided' }}</p>
        </div>
        <!-- Bank Name -->
        <div class="mb-4">
            <label class="block font-medium">Bank Name:</label>
            <p>{{ $employee->bank_name ?? 'Not provided' }}</p>
        </div>
        <!-- Branch Location -->
        <div class="mb-4">
            <label class="block font-medium">Branch Location:</label>
            <p>{{ $employee->branch_location ?? 'Not provided' }}</p>
        </div>
        <!-- Swift Code -->
        <div class="mb-4">
            <label class="block font-medium">Swift Code:</label>
            <p>{{ $employee->swift_code ?? 'Not provided' }}</p>
        </div>
    </div>
</div>
@endsection
