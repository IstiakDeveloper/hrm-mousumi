@extends('layouts.app')

@section('content')
<div class="container mx-auto py-4">
    <div class="flex justify-between items-center mb-4">
        <h1 class="text-2xl font-semibold">Deduction Option</h1>
        <div>
            <a href="{{ route('deduction_options.create') }}" class="bg-blue-500 text-white py-2 px-4 rounded hover:bg-blue-600">Create Allowance Option</a>
        </div>
    </div>
    @if (count($deductionOptions) > 0)
    <table class="min-w-full">
        <thead>
            <tr>
                <th class="py-2 px-4 bg-gray-100">ID</th>
                <th class="py-2 px-4 bg-gray-100">Deduction Option</th>
                <th class="py-2 px-4 bg-gray-100">Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($deductionOptions as $deduction)
            <tr>
                <td class="py-2 px-4 text-center">{{ $deduction->id }}</td>
                <td class="py-2 px-4 text-center">{{ $deduction->deduction_option }}</td>
                <td class="py-2 px-4 text-center">
                    <form class="inline-block" action="{{ route('deduction_options.destroy', $deduction) }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="text-red-500 hover:underline" onclick="return confirm('Are you sure?')">Delete</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
    @else
    <p class="mt-4">No Deduction option found.</p>
    @endif
</div>
@endsection
