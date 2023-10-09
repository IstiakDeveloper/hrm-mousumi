@extends('layouts.app')

@section('content')
<div class="container mx-auto py-4">
    <div class="flex justify-between items-center mb-4">
        <h1 class="text-2xl font-semibold">Branches</h1>
        <a href="{{ route('branches.create') }}" class="bg-blue-500 text-white py-2 px-4 my-2 rounded hover:bg-blue-600">Create Branch</a>
    </div>
    @if (count($branches) > 0)
    <table class="min-w-full bg-white border border-gray-300">
        <thead>
            <tr>
                <th class="py-2 px-4 border-b">ID</th>
                <th class="py-2 px-4 border-b">Name</th>
                <th class="py-2 px-4 border-b">Address</th>
                <th class="py-2 px-4 border-b">Contact Information</th>
                <th class="py-2 px-4 border-b">Actions</th>
            </tr>
        </thead>
        <tbody class="divide-y divide-gray-200">
            @foreach ($branches as $branch)
            <tr>
                <td class="py-2 px-4 text-center border-b">{{ $branch->id }}</td>
                <td class="py-2 px-4 text-center border-b">{{ $branch->name }}</td>
                <td class="py-2 px-4 text-center border-b">{{ $branch->address }}</td>
                <td class="py-2 px-4 text-center border-b">{{ $branch->contact_information }}</td>
                <td class="py-2 px-4 text-center border-b">
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
