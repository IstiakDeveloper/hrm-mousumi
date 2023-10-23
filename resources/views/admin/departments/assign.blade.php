@extends('layouts.app')

@section('content')
<div class="mx-auto max-w-md p-6 bg-white rounded shadow-lg">
    <h1 class="text-2xl font-semibold mb-6">Assign Department Head</h1>
    <form method="POST" action="{{ url('assign-department-head') }}">
        @csrf

        <div class="mb-4">
            <label for="department_id" class="block font-medium">Select a Department:</label>
            <select name="department_id" class="border border-gray-300 rounded p-2 w-full" required>
                @foreach ($departments as $department)
                    <option value="{{ $department->id }}">
                        {{ $department->branch->name }} - {{ $department->name }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="mb-4">
            <label for="user_id" class="block font-medium">Select a Department Head:</label>
            <select name="user_id" class="border border-gray-300 rounded p-2 w-full" required>
                @foreach ($users as $user)
                    <option value="{{ $user->id }}">{{ $user->name }}</option>
                @endforeach
            </select>
        </div>

        <button type="submit" class="bg-blue-500 text-white py-2 px-4 rounded hover:bg-blue-600">Assign Department Head</button>
    </form>

    @if ($errors->has('branch_mismatch'))
        <div class="mt-4 text-red-500">{{ $errors->first('branch_mismatch') }}</div>
    @endif

    @if (session('error'))
        <div class="mt-4 text-red-500">{{ session('error') }}</div>
    @endif

    @if (session('success'))
        <div class="mt-4 text-green-500">{{ session('success') }}</div>
    @endif
</div>
@endsection
