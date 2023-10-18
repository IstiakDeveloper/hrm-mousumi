@extends('layouts.app')

@section('content')
<div class="container mx-auto py-4">
    <div class="flex justify-between items-center mb-4">
        <h1 class="text-2xl font-semibold">All Permission</h1>
        <div class="flex justify-end">
            <a href="{{ route('permission.create') }}" class="bg-blue-500 text-white py-2 px-4 m-2 rounded hover:bg-blue-600">Create Permission</a>
            <a href="{{ route('permission.import') }}" class="bg-green-500 text-white py-2 px-4 m-2 rounded hover:bg-blue-600">Import</a>
            <a href="{{ route('permission.export') }}" class="bg-red-500 text-white py-2 px-4 m-2 rounded hover:bg-blue-600">Export</a>
        </div>
    </div>
    @if (count($permissions) > 0)
    <table class="min-w-full bg-white border border-gray-300">
        <thead>
            <tr>
                <th class="py-2 px-4 bg-gray-100">SL</th>
                <th class="py-2 px-4 bg-gray-100">Permission Name</th>
                <th class="py-2 px-4 bg-gray-100">Group Name</th>
                <th class="py-2 px-4 bg-gray-100">Actions</th>
            </tr>
        </thead>
        <tbody class="divide-y divide-gray-200">
            @foreach ($permissions as $key => $item )
            <tr>
                <td class="py-2 px-4 text-center">{{ $key+1 }}</td>
                <td class="py-2 px-4 text-center">{{ $item->name }}</td>
                <td class="py-2 px-4 text-center">{{ $item->group_name }}</td>
                <td class="py-2 px-4 text-center">
                    <a href="{{ route('permission.edit', $item->id) }}" class="text-yellow-500 hover:underline"><i class="fa-solid mr-2 fa-pen-to-square"></i></a>
                    <form class="inline-block" action="{{ route('permission.destroy', $item->id) }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="text-red-500 hover:underline" onclick="return confirm('Are you sure?')"><i class="fa-solid fa-trash"></i></button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
    @else
    <p class="mt-4">No permission found.</p>
    @endif
</div>
@endsection
