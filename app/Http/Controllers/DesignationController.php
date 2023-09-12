<?php
namespace App\Http\Controllers;

use App\Models\Department;
use Illuminate\Http\Request;
use App\Models\Designation;

class DesignationController extends Controller
{
    public function index()
    {
        $designations = Designation::all(); // You may adjust this query as needed

        return view('admin.designations.index', compact('designations'));
    }

    public function create()

    {
        $departments = Department::all();
        return view('admin.designations.create', compact('departments'));
    }

    public function store(Request $request)
    {
        // Validate and store designation data
        $data = $request->validate([
            'name' => 'required|string',
            'description' => 'nullable|string',
            'branch_id' => 'required|integer',
        ]);

        Designation::create($data);

        return redirect()->route('admin.designations.index')->with('success', 'Designation created successfully');
    }

    public function edit(Designation $designation)
    {
        return view('admin.designations.edit', compact('designation'));
    }

    public function update(Request $request, Designation $designation)
    {
        // Validate and update designation data
        $data = $request->validate([
            'name' => 'required|string',
            'description' => 'nullable|string',
        ]);

        $designation->update($data);

        return redirect()->route('designations.index')->with('success', 'Designation updated successfully');
    }

    public function destroy(Designation $designation)
    {
        $designation->delete();

        return redirect()->route('designations.index')->with('success', 'Designation deleted successfully');
    }
}
