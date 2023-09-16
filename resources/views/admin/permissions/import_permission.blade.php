@extends('layouts.app')

@section('content')
<div class="container mx-auto py-4">

    <a href="{{ route('permission.export') }}" class="bg-green-500 text-white py-2 px-4 m-2 rounded hover:bg-blue-600">Download Xlsx</a>
    <h1 class="text-2xl font-semibold">Import Permisiion </h1>

    <form action="{{ route('import') }}" method="POST" class="mt-4" enctype="multipart/form-data">
        @csrf
        <div class="mb-4">
            <label for="name" class="block font-medium">Xlsx File Import:</label>
            <input type="file" name="import_file" class="border border-gray-300 rounded p-2 w-full" required>
        </div>
        <button type="submit" class="bg-blue-500 text-white py-2 px-4 rounded hover:bg-blue-600">Upload</button>
    </form>
</div>
@endsection
