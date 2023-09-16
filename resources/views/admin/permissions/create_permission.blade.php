@extends('layouts.app')

@section('content')
<div class="container mx-auto py-4">
    <h1 class="text-2xl font-semibold">Create Permisiion </h1>
    <form action="{{ route('permission.store') }}" method="POST" class="mt-4">
        @csrf
        <div class="mb-4">
            <label for="name" class="block font-medium">Name:</label>
            <input type="text" name="name" id="name" class="border border-gray-300 rounded p-2 w-full" required>
        </div>
        <div class="mb-4">
            <label for="group_name" class="block font-medium">Group Name:</label>
            <select name="group_name" id="group_id" class="border border-gray-300 rounded p-2 w-full" required>
                    <option selected="" disabled="">Select Group</option>
                    <option value="dashboard">Dashboard</option>
                    <option value="branch">Branch</option>
                    <option value="department">Department</option>
                    <option value="designation">Designation</option>
                    <option value="employee">Employee</option>
                    <option value="roll_permission">Roll & Permission</option>
                    <option value="users">Users</option>
                    <option value="branch">Branch</option>
                    <option value="branch">Branch</option>
                    <option value="branch">Branch</option>
                    <option value="branch">Branch</option>
            </select>
        </div>
        <button type="submit" class="bg-blue-500 text-white py-2 px-4 rounded hover:bg-blue-600">Create Permission</button>
    </form>
</div>
@endsection
