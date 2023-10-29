<?php
namespace App\Http\Controllers;

use App\Models\Department;
use App\Models\SalaryGrade;
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
        $grades = SalaryGrade::all(); // Fetch available grades
        return view('admin.designations.create', ['departments' => $departments, 'grades' => $grades]);
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|string',
            'job_description' => 'nullable|string',
            'department_id' => 'required|integer',
            'salary_grade_id' => 'required|integer',
        ]);

        $designation = new Designation($data);
        $designation->save();

        $salaryGrade = SalaryGrade::find($data['salary_grade_id']);
        $designation->salaryGrade()->associate($salaryGrade);
        $designation->save();

        return redirect()->route('designations.index')->with('success', 'Designation created successfully');
    }

    public function edit(Designation $designation)
    {
        $departments = Department::all();
        $salaryGrades = SalaryGrade::all();
        return view('admin.designations.edit', compact('designation', 'departments', 'salaryGrades'));
    }

    public function update(Request $request, Designation $designation)
    {
        // Validate and update designation data
        $data = $request->validate([
            'name' => 'required|string',
            'description' => 'nullable|string',
            'salary_grade_id' => 'required|integer'
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
