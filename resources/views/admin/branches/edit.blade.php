@extends('layouts.app')

@section('content')
<div class="container mx-auto py-4">
    <h1 class="text-2xl font-semibold">Edit Branch</h1>
    <form action="{{ route('branches.update', $branch->id) }}" method="POST" class="mt-4">
        @csrf
        @method('PUT')
        <div class="mb-4">
            <label for="name" class="block font-medium">Name:</label>
            <input type="text" name="name" id="name" class="border border-gray-300 rounded p-2 w-full" value="{{ $branch->name }}" required>
        </div>
        <div class="mb-4">
            <label for="address" class="block font-medium">Address:</label>
            <input type="text" name="address" id="address" class="border border-gray-300 rounded p-2 w-full" value="{{ $branch->address }}" required>
        </div>
        <div class="mb-4">
            <label for="contact_information" class="block font-medium">Contact Information:</label>
            <input type="text" name="contact_information" id="contact_information" class="border border-gray-300 rounded p-2 w-full" value="{{ $branch->contact_information }}">
        </div>
        <button type="submit" class="bg-blue-500 text-white py-2 px-4 rounded hover:bg-blue-600">Update Branch</button>
    </form>
</div>
@endsection
