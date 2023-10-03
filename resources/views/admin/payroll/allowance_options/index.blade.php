@extends('layouts.app')

@section('content')
<div class="container mx-auto py-4">
    <div class="flex justify-between items-center mb-4">
        <h1 class="text-2xl font-semibold">Allowance Option</h1>
        <div>
            <a href="{{ route('allowance_options.create') }}" class="bg-blue-500 text-white py-2 px-4 rounded hover:bg-blue-600">Create Allowance Option</a>
        </div>
    </div>
    @if (count($allowanceOptions) > 0)
    <table class="min-w-full">
        <thead>
            <tr>
                <th class="py-2 px-4 bg-gray-100">ID</th>
                <th class="py-2 px-4 bg-gray-100">Allowance Option</th>
                <th class="py-2 px-4 bg-gray-100">Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($allowanceOptions as $allowance)
            <tr>
                <td class="py-2 px-4 text-center">{{ $allowance->id }}</td>
                <td class="py-2 px-4 text-center">{{ $allowance->allowance_option }}</td>
                <td class="py-2 px-4 text-center">
                    <form class="inline-block" action="{{ route('allowance_options.destroy', $allowance) }}" method="POST">
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
    <p class="mt-4">No Allowance option found.</p>
    @endif
</div>
@endsection
