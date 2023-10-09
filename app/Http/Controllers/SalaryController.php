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
        return view('admin.payroll.salary.index', compact('employees'));
    }

    public function showSetSalaryForm($employeeId)
    {
        $employee = Employee::find($employeeId);
        $allowanceOptions = AllowanceOption::all();
        $deductionOptions = DeductionOption::all();
        $loanOptions = LoanOption::all();
        $payslipTypes = PayslipType::all();
        $totalSalary = Payslip::where('employee_id', $employeeId)->sum('basic_salary');
        $salary = Salary::where('employee_id', $employeeId)->first();
        return view('admin.payroll.salary.set', compact('employee', 'allowanceOptions', 'deductionOptions', 'salary', 'loanOptions', 'payslipTypes', 'totalSalary'));
    }

    public function setSalary(Request $request, $employeeId)
    {
        // Get the employee
        $employee = Employee::findOrFail($employeeId);

        // Calculate total salary from payslips
        $totalSalary = $employee->payslips()->sum('basic_salary');

        // Calculate total allowances
        $totalAllowances = $employee->allowances()->sum('amount');

        // Calculate total loans
        $totalLoans = $employee->loans()->sum('loan_amount');

        // Calculate total deductions
        $totalDeductions = $employee->deductions()->sum('deduction_amount');

        // Calculate net salary
        $netSalary = $totalSalary + $totalAllowances - $totalLoans - $totalDeductions;

        // Check if a salary record exists for the employee, if not create a new one
        $salary = Salary::updateOrCreate(
            ['employee_id' => $employeeId],
            ['salary' => $totalSalary, 'net_salary' => $netSalary]
        );

        // Redirect back or do something based on your application's flow
        return redirect()->back()->with('success', 'Salary and net salary updated successfully.');
    }

    public function createPayslip(Request $request, $employeeId)
    {
        $request->validate([
            'payslip_type_id' => 'required|exists:payslip_types,id',
            'basic_salary' => 'required|numeric|min:0.01',
        ]);

        $employee = Employee::findOrFail($employeeId);
        $payslipType = PayslipType::findOrFail($request->payslip_type_id);

        // Calculate the total amount for the payslip
        $totalAmount = $request->basic_salary;

        // Create the payslip
        $payslip = Payslip::create([
            'employee_id' => $employeeId,
            'payslip_type_id' => $request->payslip_type_id,
            'basic_salary' => $request->basic_salary,
            'total_amount' => $totalAmount,
        ]);

        // Update or create the salary record
        $this->updateOrCreateSalary($employeeId, $payslipType->name, $request->basic_salary, $request->basic_salary, $request->payslip_type_id, null, null, null);

        return back()->with('success', 'Payslip created successfully.');
    }


    public function createAllowance(Request $request, $employeeId)
    {
        $request->validate([
            'allowance_option_id' => 'required|exists:allowance_options,id',
            'title' => 'required',
            'type' => 'required',
            'amount' => 'required|numeric|min:0.01',
        ]);

        $this->updateAllowance($employeeId, $request->allowance_option_id, $request->title, $request->type, $request->amount);

        return back()->with('success', 'Allowance created successfully.');
    }

    private function updateAllowance($employeeId, $allowanceOptionId, $title, $type, $amount)
    {
        Allowance::updateOrCreate(
            ['employee_id' => $employeeId],
            [
                'allowance_option_id' => $allowanceOptionId, // Ensure this is provided
                'title' => $title,
                'type' => $type,
                'amount' => $amount,
            ]
        );
    }


    public function createLoan(Request $request, $employeeId)
    {
        $request->validate([
            'loan_option_id' => 'required|exists:loan_options,id',
            'title' => 'required|string',
            'type' => 'required|string',
            'loan_amount' => 'required|numeric|min:0.01',
        ]);

        // Get the loan option based on the provided loan_option_id
        $loanOption = LoanOption::findOrFail($request->loan_option_id);

        // Calculate the net salary after deducting the loan amount
        // Assuming 'salary' is the net salary after other deductions and allowances
        $netSalaryAfterLoan = $request->salary - $request->loan_amount;

        // Create the loan record
        $loan = Loan::create([
            'employee_id' => $employeeId,
            'loan_option_id' => $request->loan_option_id,
            'title' => $request->title,
            'type' => $request->type,
            'loan_amount' => $request->loan_amount,
            // Add other necessary columns based on your migration
        ]);

        // Update the salary or perform any other necessary actions
        // Assuming you have a method to update salary
        $this->updateSalaryAfterLoan($employeeId, $netSalaryAfterLoan);

        return back()->with('success', 'Loan created successfully.');
    }

    private function updateSalaryAfterLoan($employeeId, $netSalaryAfterLoan)
    {
        // Implement the logic to update the salary after deducting the loan amount
        // Update the salary record for the employee with ID $employeeId
    }

    public function createDeduction(Request $request, $employeeId)
    {
        $request->validate([
            'deduction_option_id' => 'required|exists:deduction_options,id',
            'title' => 'required',
            'type' => 'required',
            'deduction_amount' => 'required|numeric|min:0.01',
        ]);

        // Create the deduction
        Deduction::create([
            'employee_id' => $employeeId,
            'deduction_option_id' => $request->deduction_option_id,
            'title' => $request->title,
            'type' => $request->type,
            'deduction_amount' => $request->deduction_amount,
        ]);

        return back()->with('success', 'Deduction created successfully.');
    }

    private function updateOrCreateSalary($employeeId, $payslipType, $salary, $netSalary, $payslipTypeId, $allowanceId, $deductionId, $loanId)
    {
        // Update or create the salary record
        Salary::updateOrCreate(
            ['employee_id' => $employeeId],
            [
                'payslip_type' => $payslipType,
                'salary' => $salary,
                'net_salary' => $netSalary,
                'allowance_id' => $allowanceId,
                'deduction_id' => $deductionId,
                'loan_id' => $loanId,
                'payslip_type_id' => $payslipTypeId,
            ]
        );
    }




    public function deletePayslip($id)
    {
        $payslip = Payslip::findOrFail($id);
        // Delete the payslip
        $payslip->delete();
        return redirect()->back()->with('success', 'Payslip deleted successfully.');
    }

    public function deleteAllowance($id)
    {
        $allowance = Allowance::findOrFail($id);
        // Delete the payslip
        $allowance->delete();
        return redirect()->back()->with('success', 'Allowance deleted successfully.');
    }

    public function deleteLoan($id)
    {
        $loan = Loan::findOrFail($id);
        // Delete the payslip
        $loan->delete();
        return redirect()->back()->with('success', 'Loan deleted successfully.');
    }

    public function deleteDeduction($id)
    {
        $deduction = Deduction::findOrFail($id);
        // Delete the payslip
        $deduction->delete();
        return redirect()->back()->with('success', 'Deduction deleted successfully.');
    }
}
