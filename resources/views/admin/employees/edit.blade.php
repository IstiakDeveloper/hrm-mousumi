@extends('layouts.app')

@section('content')
<div class="container mx-auto py-4">
    <h1 class="text-2xl font-semibold mb-6">Edit Employee</h1>
    <form action="{{ route('employees.update', $employee->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PATCH')

        <!-- Grid Layout -->
        <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
            <!-- Personal Information -->
            <div class="bg-white p-4 rounded-lg shadow mb-6">
                <h2 class="text-xl font-semibold mb-4">Personal Information</h2>
                <!-- Name -->
                <div class="mb-4">
                    <label for="name" class="block font-medium">Name:</label>
                    <input type="text" name="name" id="name" class="border border-gray-300 rounded p-2 w-full" value="{{ $employee->name }}" required>
                </div>
                <!-- Phone -->
                <div class="mb-4">
                    <label for="phone" class="block font-medium">Phone:</label>
                    <input type="text" name="phone" id="phone" class="border border-gray-300 rounded p-2 w-full" value="{{ $employee->phone }}" required>
                </div>
                <!-- Date of Birth -->
                <div class="mb-4">
                    <label for="date_of_birth" class="block font-medium">Date of Birth:</label>
                    <input type="date" name="date_of_birth" id="date_of_birth" class="border border-gray-300 rounded p-2 w-full" value="{{ $employee->date_of_birth }}" required>
                </div>
                <!-- Gender -->
                <div class="mb-4">
                    <label for="gender" class="block font-medium">Gender:</label>
                    <select name="gender" id="gender" class="border border-gray-300 rounded p-2 w-full" required>
                        <option value="male" {{ $employee->gender === 'male' ? 'selected' : '' }}>Male</option>
                        <option value="female" {{ $employee->gender === 'female' ? 'selected' : '' }}>Female</option>
                        <option value="other" {{ $employee->gender === 'other' ? 'selected' : '' }}>Other</option>
                    </select>
                </div>
                <!-- Email -->
                <div class="mb-4">
                    <label for="email" class="block font-medium">Email:</label>
                    <input type="email" name="email" id="email" class="border border-gray-300 rounded p-2 w-full" value="{{ $employee->email }}" required>
                </div>
                <!-- Password -->
                <div class="mb-4">
                    <label for="password" class="block font-medium">Password:</label>
                    <input type="password" name="password" id="password" class="border border-gray-300 rounded p-2 w-full">
                </div>
                <!-- Address -->
                <div class="mb-4">
                    <label for="address" class="block font-medium">Address:</label>
                    <textarea name="address" id="address" class="border border-gray-300 rounded p-2 w-full" rows="4" required>{{ $employee->address }}</textarea>
                </div>
            </div>

            <!-- Company Information -->
            <div class="bg-white p-4 rounded-lg shadow mb-6">
                <h2 class="text-xl font-semibold mb-4">Company Information</h2>
                <!-- Employee ID -->
                <div class="mb-4">
                    <label for="employee_id" class="block font-medium">Employee ID:</label>
                    <input type="text" name="employee_id" id="employee_id" class="border border-gray-300 rounded p-2 w-full" value="{{ $employee->employee_id }}" disabled>
                </div>
                <!-- Branch -->
                <div class="mb-4">
                    <label for="branch_id" class="block font-medium">Branch:</label>
                    <select name="branch_id" id="branch_id" class="border border-gray-300 rounded p-2 w-full" required>
                        @foreach ($branches as $branch)
                            <option value="{{ $branch->id }}" {{ $employee->branch_id === $branch->id ? 'selected' : '' }}>{{ $branch->name }}</option>
                        @endforeach
                    </select>
                </div>
                <!-- Department -->
                <div class="mb-4">
                    <label for="department_id" class="block font-medium">Department:</label>
                    <select name="department_id" id="department_id" class="border border-gray-300 rounded p-2 w-full" required>
                        @foreach ($departments as $department)
                            <option value="{{ $department->id }}" {{ $employee->department_id === $department->id ? 'selected' : '' }}>{{ $department->name }}</option>
                        @endforeach
                    </select>
                </div>
                <!-- Designation -->
                <div class="mb-4">
                    <label for="designation_id" class="block font-medium">Designation:</label>
                    <select name="designation_id" id="designation_id" class="border border-gray-300 rounded p-2 w-full" required>
                        @foreach ($designations as $designation)
                            <option value="{{ $designation->id }}" {{ $employee->designation_id === $designation->id ? 'selected' : '' }}>{{ $designation->name }}</option>
                        @endforeach
                    </select>
                </div>
                <!-- Date of Joining -->
                <div class="mb-4">
                    <label for="date_of_joining" class="block font-medium">Date of Joining:</label>
                    <input type="date" name="date_of_joining" id="date_of_joining" class="border border-gray-300 rounded p-2 w-full" value="{{ $employee->date_of_joining }}" required>
                </div>
            </div>

            <!-- Document -->
            <div class="bg-white p-4 rounded-lg shadow mb-6">
                <h2 class="text-xl font-semibold mb-4">Document</h2>
                <!-- Certificate -->
                <div class="mb-4">
                    <label for="certificate" class="block font-medium">Certificate:</label>
                    <input type="file" name="certificate" id="certificate" class="border border-gray-300 rounded p-2 w-full">
                    @if ($employee->certificate)
                        <p class="text-sm mt-2"><a href="{{ asset('storage/' . $employee->certificate) }}" target="_blank">View Certificate</a></p>
                    @endif
                </div>
                <!-- Resume -->
                <div class="mb-4">
                    <label for="resume" class="block font-medium">Resume:</label>
                    <input type="file" name="resume" id="resume" class="border border-gray-300 rounded p-2 w-full">
                    @if ($employee->resume)
                        <p class="text-sm mt-2"><a href="{{ asset('storage/' . $employee->resume) }}" target="_blank">View Resume</a></p>
                    @endif
                </div>
                <!-- Photo -->
                <div class="mb-4">
                    <label for="photo" class="block font-medium">Photo:</label>
                    <input type="file" name="photo" id="photo" class="border border-gray-300 rounded p-2 w-full">
                    @if ($employee->photo)
                        <img src="{{ asset('storage/' . $employee->photo) }}" alt="Employee Photo" class="w-32 h-32 mt-2">
                    @endif
                </div>
            </div>

            <!-- Bank Details -->
            <div class="bg-white p-4 rounded-lg shadow mb-6">
                <h2 class="text-xl font-semibold mb-4">Bank Details</h2>
                <!-- Account Holder Name -->
                <div class="mb-4">
                    <label for="account_holder_name" class="block font-medium">Account Holder Name:</label>
                    <input type="text" name="account_holder_name" id="account_holder_name" class="border border-gray-300 rounded p-2 w-full" value="{{ $employee->account_holder_name }}">
                </div>
                <!-- Account Number -->
                <div class="mb-4">
                    <label for="account_number" class="block font-medium">Account Number:</label>
                    <input type="text" name="account_number" id="account_number" class="border border-gray-300 rounded p-2 w-full" value="{{ $employee->account_number }}">
                </div>
                <!-- Bank Name -->
                <div class="mb-4">
                    <label for="bank_name" class="block font-medium">Bank Name:</label>
                    <input type="text" name="bank_name" id="bank_name" class="border border-gray-300 rounded p-2 w-full" value="{{ $employee->bank_name }}">
                </div>
                <!-- Branch Location -->
                <div class="mb-4">
                    <label for="branch_location" class="block font-medium">Branch Location:</label>
                    <input type="text" name="branch_location" id="branch_location" class="border border-gray-300 rounded p-2 w-full" value="{{ $employee->branch_location }}">
                </div>
                <!-- Swift Code -->
                <div class="mb-4">
                    <label for="swift_code" class="block font-medium">Swift Code:</label>
                    <input type="text" name="swift_code" id="swift_code" class="border border-gray-300 rounded p-2 w-full" value="{{ $employee->swift_code }}">
                </div>
            </div>
        </div>
        <!-- Submit Button -->
        <div class="mb-6">
            <button type="submit" class="bg-blue-500 text-white py-2 px-4 rounded hover:bg-blue-600">Update Employee</button>
        </div>
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
