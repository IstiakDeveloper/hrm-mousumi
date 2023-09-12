@extends('layouts.app')

@section('content')
<div class="container mx-auto py-4">
    <h1 class="text-2xl font-semibold">Branches</h1>
    <a href="{{ route('branches.create') }}" class="bg-blue-500 text-white py-2 px-4 my-2 rounded hover:bg-blue-600">Create Branch</a>
    @if (count($branches) > 0)
    <table class="min-w-full">
        <thead>
            <tr>
                <th class="py-2 px-4 bg-gray-100">ID</th>
                <th class="py-2 px-4 bg-gray-100">Name</th>
                <th class="py-2 px-4 bg-gray-100">Address</th>
                <th class="py-2 px-4 bg-gray-100">Contact Information</th>
                <th class="py-2 px-4 bg-gray-100">Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($branches as $branch)
            <tr>
                <td class="py-2 px-4 text-center">{{ $branch->id }}</td>
                <td class="py-2 px-4 text-center">{{ $branch->name }}</td>
                <td class="py-2 px-4 text-center">{{ $branch->address }}</td>
                <td class="py-2 px-4 text-center">{{ $branch->contact_information }}</td>
                <td class="py-2 px-4 text-center">
                    <a href="{{ route('branches.show', $branch->id) }}" class="text-blue-500 hover:underline">View</a>
                    <a href="{{ route('branches.edit', $branch->id) }}" class="text-yellow-500 hover:underline">Edit</a>
                    <form class="inline-block" action="{{ route('branches.destroy', $branch->id) }}" method="POST">
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
    <p class="mt-4">No branches found.</p>
    @endif
</div>
@endsection
