@extends('layouts.app')

@section('content')
<style>
    label span{
        text-transform: capitalize;
    }
</style>
<div class="container mx-auto py-4">
    <h1 class="text-2xl font-semibold">Edit Roles in Permisiion </h1>
    <form action="{{ route('admin.roles.update', $role->id) }}" method="POST" class="mt-4">
        @csrf
        <div class="mb-4">
            <label for="group_name" class="block font-medium">Role Name:</label>
            <h3>{{$role->name}}</h3>

        </div>
        <div class="mb-4">
            <label class="flex items-center">
                <input type="checkbox" id="checkDefaultMain" class="form-checkbox">
                <span class="ml-2" for="checkDefaultMain">All Permissions</span>
            </label>
        </div>
        @foreach ($permission_groups as $group)
            <div class="flex">
                <div class="w-1/3 ">

                    @php
                        $permissions = App\Models\User::getpermissionByGroupName($group->group_name)
                    @endphp

                    <label class="flex items-center">
                        <input type="checkbox" class="form-checkbox" {{App\Models\User::roleHasPermissions($role, $permissions) ? 'checked' : ''}}>
                        <span class="ml-2">{{$group->group_name}}</span>
                    </label>
                </div>

                <div class="w-2/3">
                    @foreach ($permissions as $permission)
                    <label class="flex items-center">
                        <input type="checkbox" name="permission[]" id="checkDefault{{$permission->id}}" value="{{$permission->id}}" class="form-checkbox" {{$role->hasPermissionTo($permission->name) ? 'checked' : ''}}>
                        <span class="ml-2" for="checkDefault{{$permission->id}}">{{$permission->name}}</span>
                    </label>
                    @endforeach
                    <br>
                </div>
            </div>
        @endforeach
        <button type="submit" class="bg-blue-500 text-white py-2 px-4 rounded hover:bg-blue-600">Save Changes</button>
    </form>
</div>


    <script type="text/javascript">
    document.getElementById('checkDefaultMain').addEventListener('click', function() {
        var checkboxes = document.querySelectorAll('input[type="checkbox"]');
        for (var i = 0; i < checkboxes.length; i++) {
            checkboxes[i].checked = this.checked;
        }
    });
    </script>

@endsection
