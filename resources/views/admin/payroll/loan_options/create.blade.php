@extends('layouts.app')
@section('content')
<div class="container mx-auto py-4">
    <h1 class="text-2xl font-semibold mb-6">Create Loan Option</h1>
    <form action="{{ route('loan_options.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="mb-4">
            <label for="loan_option" class="block font-medium">loan Option:</label>
            <input type="text" name="loan_option" id="loan_option" class="border border-gray-300 rounded p-2 w-full" required>
        </div>
        <!-- Submit Button -->
        <div class="mb-6">
            <button type="submit" class="bg-blue-500 text-white py-2 px-4 rounded hover:bg-blue-600">Create Loan Option</button>
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
