@extends('layouts.app')

@section('content')
    <div class="container mx-auto">
        <div class="max-w-md mx-auto my-10 bg-white p-5 rounded shadow-lg">
            <div class="text-center mb-4">
                <h2 class="text-lg font-bold">Transfer Employee</h2>
            </div>
            <div class="mb-4">
                <p class="text-lg font-bold">Name: {{ $employee->name }}</p>
            </div>

            @if (session('error'))
                <div class="alert alert-danger">
                    {{ session('error') }}
                </div>
            @endif

            <form action="{{ route('employees.transfer', $employee) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="mb-4">
                    <label for="branch_id" class="block mb-2 font-bold">Branch</label>
                    <select id="branch_id" name="branch_id" class="w-full py-2 px-3 border border-gray-300 rounded">
                        <option value="">Select Branch</option>
                        @foreach ($branches as $branch)
                            <option value="{{ $branch->id }}" {{ $branch->id == $employee->branch_id ? 'selected' : '' }}>
                                {{ $branch->name }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="mb-4">
                    <label for="department_id" class="block mb-2 font-bold">Department</label>
                    <select id="department_id" name="department_id" class="w-full py-2 px-3 border border-gray-300 rounded">
                        <option value="">Select Department</option>
                        @foreach ($departments as $department)
                            <option value="{{ $department->id }}" {{ $department->id == $employee->department_id ? 'selected' : '' }}>
                                {{ $department->name }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="mb-4">
                    <label for="designation_id" class="block mb-2 font-bold">Designation</label>
                    <select id="designation_id" name="designation_id" class="w-full py-2 px-3 border border-gray-300 rounded">
                        <option value="">Select Designation</option>
                        @foreach ($designations as $designation)
                            <option value="{{ $designation->id }}" {{ $designation->id == $employee->designation_id ? 'selected' : '' }}>
                                {{ $designation->name }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <button type="submit" class="py-2 px-4 bg-blue-500 text-white rounded">Transfer Employee</button>
            </form>
        </div>
    </div>
@endsection
