@extends('layouts.app')

@section('content')
<div class="bg-gray-100">
    <div class="max-w-6xl mx-auto py-8">
        <div class="bg-white shadow-lg rounded-lg overflow-hidden">
            <div class="p-4 flex justify-end">
                <a href="{{ route('employees.print', ['employee' => $employee->id]) }}" class="bg-blue-500 text-white px-4 py-2 rounded-full mr-2 hover:bg-blue-600">Print</a>
                <a href="{{ route('employees.download', ['employee' => $employee]) }}" class="bg-green-500 text-white px-4 py-2 rounded-full hover:bg-green-600">Download PDF</a>
            </div>
            <div class="px-6 py-4">
                <div class="text-center">
                    <div class="w-32 h-32 bg-gray-300 rounded-full mx-auto">
                        @if ($employee->photo)
                            <img src="{{ asset('storage/' . $employee->photo) }}" alt="Employee Photo" class="w-32 h-32 rounded-full">
                        @else
                            <span class="text-gray-600 text-4xl flex items-center justify-center h-full w-full">No Photo</span>
                        @endif
                    </div>
                    <h1 class="text-2xl font-semibold mt-4">{{ $employee->name }}</h1>
                    <p class="text-gray-600">Employee ID: {{ $employee->employee_id }}</p>
                </div>
            </div>
            <div class="border-t border-gray-300">
                <div class="px-6 py-4">
                    <h2 class="text-xl font-semibold mb-4">Personal Information</h2>
                    <dl class="grid grid-cols-2 gap-6">
                        <div class="mb-4">
                            <dt class="font-medium">Phone:</dt>
                            <dd>{{ $employee->phone }}</dd>
                        </div>
                        <div class="mb-4">
                            <dt class="font-medium">Date of Birth:</dt>
                            <dd>{{ $employee->date_of_birth }}</dd>
                        </div>
                        <div class="mb-4">
                            <dt class="font-medium">Gender:</dt>
                            <dd>{{ $employee->gender }}</dd>
                        </div>
                        <div class="mb-4">
                            <dt class="font-medium">Email:</dt>
                            <dd>{{ $employee->email }}</dd>
                        </div>
                        <div class="mb-4">
                            <dt class="font-medium">Address:</dt>
                            <dd>{{ $employee->address }}</dd>
                        </div>
                    </dl>
                </div>
            </div>
            <div class="border-t border-gray-300">
                <div class="px-6 py-4">
                    <h2 class="text-xl font-semibold mb-4">Company Information</h2>
                    <dl class="grid grid-cols-2 gap-6">
                        <div class="mb-4">
                            <dt class="font-medium">Branch:</dt>
                            <dd>{{ $employee->branch->name }}</dd>
                        </div>
                        <div class="mb-4">
                            <dt class="font-medium">Department:</dt>
                            <dd>{{ $employee->department->name }}</dd>
                        </div>
                        <div class="mb-4">
                            <dt class="font-medium">Designation:</dt>
                            <dd>{{ $employee->designation->name }}</dd>
                        </div>
                        <div class="mb-4">
                            <dt class="font-medium">Date of Joining:</dt>
                            <dd>{{ $employee->date_of_joining }}</dd>
                        </div>
                    </dl>
                </div>
            </div>
            <div class="border-t border-gray-300">
                <div class="px-6 py-4">
                    <h2 class="text-xl font-semibold mb-4">Document Information</h2>
                    <dl class="grid grid-cols-2 gap-6">
                        <div class="mb-4">
                            <dt class="font-medium">Certificate:</dt>
                            <dd>
                                @if ($employee->certificate)
                                    <a href="{{ asset('storage/' . $employee->certificate) }}" class="text-blue-500 hover:underline" target="_blank">View Certificate</a>
                                @else
                                    No certificate uploaded
                                @endif
                            </dd>
                        </div>
                        <div class="mb-4">
                            <dt class="font-medium">Resume:</dt>
                            <dd>
                                @if ($employee->resume)
                                    <a href="{{ asset('storage/' . $employee->resume) }}" class="text-blue-500 hover:underline" target="_blank">View Resume</a>
                                @else
                                    No resume uploaded
                                @endif
                            </dd>
                        </div>
                    </dl>
                </div>
            </div>
            <div class="border-t border-gray-300">
                <div class="px-6 py-4">
                    <h2 class="text-xl font-semibold mb-4">Bank Details</h2>
                    <dl class="grid grid-cols-2 gap-6">
                        <div class="mb-4">
                            <dt class="font-medium">Account Holder Name:</dt>
                            <dd>{{ $employee->account_holder_name ?? 'Not provided' }}</dd>
                        </div>
                        <div class="mb-4">
                            <dt class="font-medium">Account Number:</dt>
                            <dd>{{ $employee->account_number ?? 'Not provided' }}</dd>
                        </div>
                        <div class="mb-4">
                            <dt class="font-medium">Bank Name:</dt>
                            <dd>{{ $employee->bank_name ?? 'Not provided' }}</dd>
                        </div>
                        <div class="mb-4">
                            <dt class="font-medium">Branch Location:</dt>
                            <dd>{{ $employee->branch_location ?? 'Not provided' }}</dd>
                        </div>
                        <div class="mb-4">
                            <dt class="font-medium">Swift Code:</dt>
                            <dd>{{ $employee->swift_code ?? 'Not provided' }}</dd>
                        </div>
                    </dl>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
