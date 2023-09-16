<?php

namespace App\Http\Controllers;

use App\Exports\PermissionExport;
use App\Imports\PermissionImport;
use App\Models\User;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use Spatie\Permission\Models\Permission;
use PhpOffice\PhpSpreadsheet\IOFactory;
use Spatie\Permission\Models\Role;
use DB;

class RoleController extends Controller
{
    public function AllPermission(){
        $permissions = Permission::all();

        return view('admin.permissions.all_permission', compact('permissions'));
    } //end method

    public function CreatePermission(){
        return view('admin.permissions.create_permission');
    } //end method

    public function StorePermission(Request $request) {
        $permission = Permission::create([
            'name' => $request->name,
            'group_name' => $request->group_name
        ]);

        return redirect()->route('all.permission');
    }

    public function EditPermission($id) {
        $permission = Permission::findOrFail($id);
        return view('admin.permissions.edit_permission', compact('permission'));
    }

    public function UpdatePermission(Request $request) {

        $per_id = $request->id;

        Permission::findOrFail($per_id)->update([
            'name' => $request->name,
            'group_name' => $request->group_name
        ]);

        return redirect()->route('all.permission');
    }

    public function DestroyPermission($id){
        Permission::findOrFail($id)->delete();
        return redirect()->route('all.permission');
    }

    public function ImportPermission(){
        return view('admin.permissions.import_permission');
    }

    public function Export(){
        return Excel::download(new PermissionExport, 'permission.xlsx');
    }

    public function Import(Request $request){
        Excel::import(new PermissionImport, $request->file('import_file'));

        return redirect()->route('all.permission')->with('success', 'All good!');
    }


    //Roles Function start from here

    public function AllRoles(){
        $roles = Role::all();
        return view('admin.roles.all_roles', compact('roles'));
    }

    public function CreateRole(){
        return view('admin.roles.create_role');
    }

    public function StoreRole(Request $request) {
        Role::create([
            'name' => $request->name,
        ]);
        return redirect()->route('role.all');
    }

    public function EditRole($id) {
        $role = Role::findOrFail($id);
        return view('admin.roles.edit_role', compact('role'));
    }

    public function UpdateRole(Request $request) {

        $per_id = $request->id;

        Role::findOrFail($per_id)->update([
            'name' => $request->name,
        ]);

        return redirect()->route('role.all');
    }

    public function DestroyRole($id){
        Role::findOrFail($id)->delete();
        return redirect()->route('role.all');
    }



    //Setup Roles in permission
    public function AddRolesPermission(){
        $roles = Role::all();
        $permissions = Permission::all();
        $permission_groups = User::getpermissionGroups();

        return view('admin.rolesetup.add_roles_permission', compact('roles', 'permissions', 'permission_groups'));
    }

    public function StoreRolesPermission(Request $request){
        $data = [];
        $permissions = $request->permission;

        foreach ($permissions as $permission_id) {
            $data[] = [
                'role_id' => $request->group_name, // Assuming group_name holds role_id
                'permission_id' => $permission_id
            ];
        }

        DB::table('role_has_permissions')->insert($data);

        return redirect()->back();
    }

    public function AllRolesPermission() {
        $roles = Role::all();
        return view('admin.rolesetup.all_roles_permission', compact('roles'));
    }



}
