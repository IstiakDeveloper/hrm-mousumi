@extends('layouts.app')

@section('content')
<div class="container mx-auto p-4">
    <h1 class="text-2xl mb-4">Create Leave Type</h1>
    <form action="{{ route('leave_types.store') }}" method="POST" class="max-w-md">
        @csrf

        <!-- Leave Type -->
        <div class="mb-4">
            <label for="leave_type" class="block text-gray-700 text-sm font-bold mb-2">Leave Type:</label>
            <input type="text" name="leave_type" id="leave_type" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
            @error('leave_type')
                <p class="text-red-500 text-xs italic">{{ $message }}</p>
            @enderror
        </div>

        <!-- Days -->
        <div class="mb-4">
            <label for="day" class="block text-gray-700 text-sm font-bold mb-2">Days:</label>
            <input type="number" name="day" id="day" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
            @error('day')
                <p class="text-red-500 text-xs italic">{{ $message }}</p>
            @enderror
        </div>

        <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">Submit</button>
    </form>
</div>
@endsection
