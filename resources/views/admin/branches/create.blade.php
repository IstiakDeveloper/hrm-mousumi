@extends('layouts.app')

@section('content')
<div class="container mx-auto py-4">
    <h1 class="text-2xl font-semibold">Create Branch</h1>
    <form action="{{ route('branches.store') }}" method="POST" class="mt-4">
        @csrf
        <div class="mb-4">
            <label for="name" class="block font-medium">Name:</label>
            <input type="text" name="name" id="name" class="border border-gray-300 rounded p-2 w-full" required>
        </div>
        <div class="mb-4">
            <label for="address" class="block font-medium">Address:</label>
            <input type="text" name="address" id="address" class="border border-gray-300 rounded p-2 w-full" required>
        </div>
        <div class="mb-4">
            <label for="contact_information" class="block font-medium">Contact Information:</label>
            <input type="text" name="contact_information" id="contact_information" class="border border-gray-300 rounded p-2 w-full">
        </div>
        <button type="submit" class="bg-blue-500 text-white py-2 px-4 rounded hover:bg-blue-600">Create Branch</button>
    </form>
</div>
@endsection
