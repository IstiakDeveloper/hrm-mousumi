<?php

namespace App\Http\Controllers;

use App\Models\Branch;
use Illuminate\Http\Request;
use App\Models\Department;
use App\Models\User;
use Illuminate\Support\Facades\Validator;

class DepartmentController extends Controller
{
    public function index()
    {
        $departments = Department::all();
        return view('admin.departments.index', compact('departments'));
    }

    public function create()
    {
        $branches = Branch::all();
        return view('admin.departments.create', compact('branches'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|string',
            'description' => 'nullable|string',
            'branch_id' => 'required|exists:branches,id', // Validate the branch_id
        ]);

        Department::create($data);

        return redirect()->route('departments.index')->with('success', 'Department created successfully');
    }

    public function show($id)
    {
        $department = Department::findOrFail($id);
        return view('admin.departments.show', compact('department'));
    }

    public function edit($id)
    {
        $department = Department::findOrFail($id);
        return view('admin.departments.edit', compact('department'));
    }

    public function update(Request $request, $id)
    {
        $department = Department::findOrFail($id);

        // Validate and update department data
        $data = $request->validate([
            'name' => 'required|string',
            'description' => 'nullable|string',
        ]);

        $department->update($data);

        return redirect()->route('departments.index')->with('success', 'Department updated successfully');
    }

    public function destroy($id)
    {
        $department = Department::findOrFail($id);
        $department->delete();

        return redirect()->route('departments.index')->with('success', 'Department deleted successfully');
    }


    public function assignHead()
    {
        $departments = Department::all();
        $users = User::all();
        return view('admin.departments.assign', compact('departments', 'users'));
    }

    public function storeHead(Request $request)
    {
        $department = Department::find($request->input('department_id'));
        $user = User::find($request->input('user_id'));

        // Check if the department and user belong to the same branch
        if ($department->branch_id === $user->branch_id) {
            $department->update(['department_head_id' => $user->id]);
            return redirect()->route('departments.index')->with('success', 'Department head assigned successfully');
        } else {
            return redirect()->route('assign.head')->with('error', 'Selected department and user are not in the same branch.');
        }
    }



}

