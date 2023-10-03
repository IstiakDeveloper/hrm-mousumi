<?php

namespace App\Http\Controllers;

use App\Models\Salary;
use App\Models\Allowance;
use App\Models\AllowanceOption;
use App\Models\Deduction;
use App\Models\DeductionOption;
use App\Models\Employee;
use App\Models\Loan;
use App\Models\LoanOption;
use App\Models\Payslip;
use App\Models\PayslipType;
use Illuminate\Http\Request;

class SalaryController extends Controller
{

    public function index()
    {
        $employees = Employee::all();
        return view('salary.index', compact('employees'));
    }

    // Method to show the form for setting salary
    public function showSetSalaryForm($employeeId)
    {
        // Retrieve the employee details
        $employee = Employee::find($employeeId);

        // Retrieve all available allowance options
        $allowanceOptions = AllowanceOption::all();

        // Retrieve all available deduction options
        $deductionOptions = DeductionOption::all();

        // Retrieve all available loan options
        $loanOptions = LoanOption::all();

        // Retrieve all available payslip types
        $payslipTypes = PayslipType::all();

        return view('admin.payroll.salary.set', compact('employee', 'allowanceOptions', 'deductionOptions', 'loanOptions', 'payslipTypes'));
    }

    // Method to set salary for an employee
    public function setSalary(Request $request, $employeeId)
    {
        // Validate the request data
        $request->validate([
            'payroll_type' => 'required',
            'salary' => 'required',
            'net_salary' => 'required',
            'allowance_id' => 'nullable|exists:allowance_options,id',
            'deduction_id' => 'nullable|exists:deduction_options,id',
            'loan_id' => 'nullable|exists:loan_options,id',
            'payslip_type_id' => 'nullable|exists:payslip_types,id',
        ]);

        // Process the request data and set the salary for the employee
        $salary = Salary::updateOrCreate(
            ['employee_id' => $employeeId],
            [
                'payroll_type' => $request->payroll_type,
                'salary' => $request->salary,
                'net_salary' => $request->net_salary,
                'allowance_id' => $request->allowance_id,
                'deduction_id' => $request->deduction_id,
                'loan_id' => $request->loan_id,
                'payslip_type_id' => $request->payslip_type_id,
                // Add other fields accordingly
            ]
        );

        // You can also handle allowances, deductions, and loans similarly
        if ($request->allowance_id) {
            Allowance::create([
                'employee_id' => $employeeId,
                'allowance_option_id' => $request->allowance_id,
                // Add other fields accordingly
            ]);
        }

        if ($request->deduction_id) {
            Deduction::create([
                'employee_id' => $employeeId,
                'deduction_option_id' => $request->deduction_id,
                // Add other fields accordingly
            ]);
        }

        if ($request->loan_id) {
            Loan::create([
                'employee_id' => $employeeId,
                'loan_option_id' => $request->loan_id,
                // Add other fields accordingly
            ]);
        }

        // Create a payslip
        Payslip::create([
            'employee_id' => $employeeId,
            'payroll_type' => $request->payroll_type,
            'salary' => $request->salary,
            'net_salary' => $request->net_salary,
            // Add other fields accordingly
        ]);

        return redirect()->route('employee.show', $employeeId)->with('success', 'Salary set successfully.');
    }
}
