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

        return view('admin.payroll.salary.set', compact('employee', 'allowanceOptions', 'deductionOptions', 'loanOptions', 'payslipTypes', 'totalSalary'));
    }

    public function setSalary(Request $request, $employeeId)
    {
        $request->validate([
            'payslip_type' => 'required',
            'salary' => 'required',
            'allowance_option_id' => 'nullable|exists:allowance_options,id',
            'deduction_id' => 'nullable|exists:deduction_options,id',
            'loan_id' => 'nullable|exists:loan_options,id',
            'payslip_type_id' => 'nullable|exists:payslip_types,id',
            'title' => 'required_if:allowance_option_id,!=,null',
            'type' => 'required_if:allowance_option_id,!=,null',
            'amount' => 'required_if:allowance_option_id,!=,null|numeric|min:0.01',
        ]);

        // Calculate the total salary based on existing payslips and the provided salary
        $existingPayslips = Payslip::where('employee_id', $employeeId)->get();
        $totalSalary = $request->salary;

        foreach ($existingPayslips as $payslip) {
            $totalSalary += $payslip->basic_salary;
        }

        // Calculate the net salary based on the provided salary and adjustments
        $netSalary = $request->salary;
        foreach ($existingPayslips as $payslip) {
            $netSalary += $payslip->basic_salary;
        }

        if ($request->allowance_option_id) {
            // Create or update allowance record
            Allowance::updateOrCreate(
                ['employee_id' => $employeeId],
                [
                    'allowance_option_id' => $request->allowance_option_id,
                    'title' => $request->title,
                    'type' => $request->type,
                    'amount' => $request->amount,
                ]
            );

            // Add allowance amount to net salary
            $netSalary += $request->amount;
        }

        if ($request->deduction_id) {
            // Create deduction record
            Deduction::create([
                'employee_id' => $employeeId,
                'deduction_option_id' => $request->deduction_id,
            ]);

            // Subtract deduction amount from net salary
            $deductionAmount = DeductionOption::findOrFail($request->deduction_id)->amount;
            $netSalary -= $deductionAmount;
        }

        if ($request->loan_id) {
            // Create loan record
            Loan::create([
                'employee_id' => $employeeId,
                'loan_option_id' => $request->loan_id,
            ]);

            // Subtract loan amount from net salary
            $loanAmount = LoanOption::findOrFail($request->loan_id)->amount;
            $netSalary -= $loanAmount;
        }

        // Calculate the total payslip amount based on the net salary and adjustments
        $totalPayslipAmount = $netSalary;

        // Create or update the salary record
        $this->updateOrCreateSalary($employeeId, $request->payslip_type, $request->salary, $netSalary, $request->payslip_type_id, $request->allowance_option_id, $request->deduction_id, $request->loan_id);

        // Create the payslip only when payslip_type is set and allowance_option_id is null
        if ($request->payslip_type && !$request->allowance_option_id) {
            $payslip = Payslip::create([
                'employee_id' => $employeeId,
                'payslip_type_id' => $request->payslip_type_id,
                'basic_salary' => $request->salary,
                'total_amount' => $totalPayslipAmount,
            ]);
        }

        // Return the appropriate response
        return back()->with('success', 'Salary set successfully.');
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
        // Logic for creating a deduction

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
}
