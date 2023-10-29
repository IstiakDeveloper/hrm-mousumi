<?php

namespace App\Http\Controllers\Salary;

use App\Http\Controllers\Controller;
use App\Models\Employee;
use App\Models\SalaryGrade;
use App\Models\SalaryStep;
use Illuminate\Http\Request;

class SalaryController extends Controller
{
    public function index()
    {
        $grades = SalaryGrade::with('steps')->get();
        $steps = SalaryStep::all();

        return view('admin.salary.index', compact('grades', 'steps'));
    }
    public function createGrade()
    {
        return view('admin.salary.grade_create');
    }

    public function storeGrade(Request $request)
    {
        $data = $request->all();

        // Handle the creation of a new salary grade
        SalaryGrade::create($data);

        // Redirect to a success page or the grades listing
        return redirect()->route('salary.index')->with('success', 'Grade created successfully.');
    }

    public function createStep()
    {
        $grades = SalaryGrade::all();
        return view('admin.salary.step_create', compact('grades'));
    }

    public function storeStep(Request $request)
    {
        $data = $request->all();

        // Calculate the fields based on the fixed amounts and percentages
        $basicSalary = $data['basic_salary'];
        $data['home_rents'] = $basicSalary * 0.7;
        $data['conveyance'] = $basicSalary * 0.2;
        $data['pf_fund'] = $basicSalary * 0.1;

        // Calculate Total Salary
        $data['total_salary'] = $basicSalary + $data['home_rents'] + $data['conveyance'] + $data['medical_allowance'] + $data['lunch'] + $data['mobile'] + $data['special_allowance'] + $data['festival_bonus'];

        // Calculate the total deduction based on the provided deduction values
        $data['total_deduction'] = array_sum([
            $data['pf_fund'],
            $data['motorcycle_loan'],
            $data['pf_loan'],
            $data['laptop_loan'],
            $data['staff_welfare'],
            $data['tax'],
        ]);

        // Calculate the net salary
        $data['net_salary'] = $data['total_salary'] - $data['total_deduction'];

        // Handle the creation of a new salary step
        SalaryStep::create($data);

        // Redirect to a success page or the steps listing
        return redirect()->back()->with('success', 'Step created successfully.');
    }

    public function showGrade($gradeId)
    {
        $grade = SalaryGrade::findOrFail($gradeId);
        $steps = $grade->steps;

        return view('admin.salary.show_grade', compact('grade', 'steps'));
    }



}
