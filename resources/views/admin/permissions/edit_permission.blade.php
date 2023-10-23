@extends('layouts.app')

@section('content')
<div class="container mx-auto py-4">
    <h1 class="text-2xl font-semibold">Create Permisiion </h1>
    <form action="{{ route('permission.update') }}" method="POST" class="mt-4">
        @csrf

        <input type="hidden" name="id" value="{{$permission->id}}">

        <div class="mb-4">
            <label for="name" class="block font-medium">Name:</label>
            <input type="text" name="name" id="name" class="border border-gray-300 rounded p-2 w-full" value="{{$permission->name}}" required>
        </div>
        <div class="mb-4">
            <label for="group_name" class="block font-medium">Group Name:</label>
            <select name="group_name" id="group_id" class="border border-gray-300 rounded p-2 w-full" required>
                    <option selected="" disabled="">Select Group</option>
                    <option value="dashboard" {{$permission->group_name == 'dashboard' ? 'selected' : ''}}>Dashboard</option>
                    <option value="hrm_setup" {{$permission->group_name == 'hrm_setup' ? 'selected' : ''}}>HRM Setup</option>
                    <option value="branch" {{$permission->group_name == 'branch' ? 'selected' : ''}}>Branch</option>
                    <option value="department" {{$permission->group_name == 'department' ? 'selected' : ''}}>Department</option>
                    <option value="designation" {{$permission->group_name == 'designation' ? 'selected' : ''}}>Designation</option>
                    <option value="employee" {{$permission->group_name == 'employee' ? 'selected' : ''}}>Employee</option>
                    <option value="timesheet" {{$permission->group_name == 'timesheet' ? 'selected' : ''}}>Timesheet</option>
                    <option value="timesheet" {{$permission->group_name == 'timesheet' ? 'selected' : ''}}>Timesheet</option>
                    <option value="payroll" {{$permission->group_name == 'payroll' ? 'selected' : ''}}>Roll & Permission</option>
                    <option value="users" {{$permission->group_name == 'users' ? 'selected' : ''}}>Users</option>
            </select>
        </div>
        <button type="submit" class="bg-blue-500 text-white py-2 px-4 rounded hover:bg-blue-600">Update Permission</button>
    </form>
</div>
@endsection
