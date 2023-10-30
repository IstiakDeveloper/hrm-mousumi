<?php

namespace App\Http\Controllers\Salary;

use App\Http\Controllers\Controller;
use App\Models\Employee;
use App\Models\EmployeeSalary;
use App\Models\Loann;
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

    public function setSalaryIndex()
    {
        $employees = Employee::all(); // Retrieve all employees
        $employeeSalaries = EmployeeSalary::with('salaryStep')->get(); // Retrieve all employee salaries with steps

        $salaryData = [];

        foreach ($employees as $employee) {
            $employeeSalary = $employeeSalaries->where('employee_id', $employee->id)->first();

            if ($employeeSalary) {
                $salaryStep = $employeeSalary->salaryStep;
                $pf_loan_total = $salaryStep->pf_loan + $employeeSalary->pf_loan;
                $laptop_loan_total = $salaryStep->laptop_loan + $employeeSalary->laptop_loan;
                $motorcycle_loan_total = $salaryStep->motorcycle_loan + $employeeSalary->motorcycle_loan;
                $deduction_total = $salaryStep->total_deduction + $employeeSalary->pf_loan + $employeeSalary->laptop_loan + $employeeSalary->motorcycle_loan;
                $salary_total = $salaryStep->total_salary - $deduction_total;

                $salaryData[] = [
                    'employee' => $employee,
                    'employeeSalary' => $employeeSalary,
                    'pf_loan_total' => $pf_loan_total,
                    'laptop_loan_total' => $laptop_loan_total,
                    'motorcycle_loan_total' => $motorcycle_loan_total,
                    'deduction_total' => $deduction_total,
                    'salary_total' => $salary_total,
                ];
            } else {
                $salaryData[] = [
                    'employee' => $employee,
                    'employeeSalary' => null,
                    'pf_loan_total' => 0,
                    'laptop_loan_total' => 0,
                    'motorcycle_loan_total' => 0,
                    'deduction_total' => 0,
                    'salary_total' => 0,
                ];
            }
        }

        return view('admin.salary.set_salary_index', [
            'salaryData' => $salaryData,

        ]);
    }


    public function setSalaryForm(Employee $employee)
    {
        $salaryGrades = SalaryGrade::all();
        $salarySteps = SalaryStep::all();
        $selectedGrade = null;
        $loans = Loann::where('employee_id', $employee->id)->get();
        $loanTypes = ['motorcycle_loan', 'pf_loan', 'laptop_loan'];

        return view('admin.salary.set_salary', [
            'employee' => $employee,
            'salaryGrades' => $salaryGrades,
            'salarySteps' => $salarySteps,
            'selectedGrade' => $selectedGrade,
            'loans' => $loans,
            'loanTypes' => $loanTypes,
        ]);
    }

    public function getStepsByGrade(Request $request, $grade)
    {
        // Retrieve the selected grade and its associated steps
        $selectedGrade = SalaryGrade::with('steps')->find($grade);

        // Return the steps associated with the grade as JSON
        return response()->json(['steps' => $selectedGrade->steps]);
    }


    public function setSalary(Request $request, Employee $employee)
    {
        $validatedData = $request->validate([
            'salary_grade_id' => 'required|exists:salary_grades,id',
            'salary_step_id' => 'required|exists:salary_steps,id',
            'motorcycle_loan' => 'nullable|numeric',
            'pf_loan' => 'nullable|numeric',
            'laptop_loan' => 'nullable|numeric',
        ]);


        // Create or update the employee's salary record
        $employeeSalary = EmployeeSalary::updateOrCreate(
            ['employee_id' => $employee->id], // Ensure 'employee_id' is set
            [
                'salary_grade_id' => $validatedData['salary_grade_id'],
                'salary_step_id' => $validatedData['salary_step_id'],
                'motorcycle_loan' => $validatedData['motorcycle_loan'] ?? 0,
                'pf_loan' => $validatedData['pf_loan'] ?? 0,
                'laptop_loan' => $validatedData['laptop_loan'] ?? 0,
            ]
        );

        return redirect()->route('set.salary.index')->with('success', 'Salary set successfully.');
    }

    public function showSalary(Employee $employee)
    {
        // Retrieve the employee's salary information using the EmployeeSalary model
        $employeeSalary = EmployeeSalary::where('employee_id', $employee->id)->first();

        if ($employeeSalary) {
            $salaryStep = $employeeSalary->salaryStep;

            // Calculate the total for fields with the same name from both tables
            $pf_loan_total = $salaryStep->pf_loan + $employeeSalary->pf_loan;
            $laptop_loan_total = $salaryStep->laptop_loan + $employeeSalary->laptop_loan;
            $motorcycle_loan_total = $salaryStep->motorcycle_loan + $employeeSalary->motorcycle_loan;
            $deduction_total = $salaryStep->total_deduction + $employeeSalary->pf_loan + $employeeSalary->laptop_loan + $employeeSalary->motorcycle_loan;
            $salary_total = $salaryStep->total_salary - $deduction_total;

            return view('admin.salary.show_salary', [
                'employee' => $employee,
                'employeeSalary' => $employeeSalary,
                'pf_loan_total' => $pf_loan_total,
                'laptop_loan_total' => $laptop_loan_total,
                'motorcycle_loan_total' => $motorcycle_loan_total,
                'deduction_total' => $deduction_total,
                'salary_total' => $salary_total,
            ]);
        } else {
            // Handle the case where the employee has no salary record
            return view('admin.salary.show_salary', [
                'employee' => $employee,
                'employeeSalary' => null, // You can pass null to indicate no salary data available
            ]);
        }
    }






}
