<?php

namespace App\Http\Controllers;

use App\Models\PayslipGenarate;
use App\Models\Employee;
use App\Models\Payslip;
use App\Models\Salary;
use Carbon\Carbon;
use Illuminate\Http\Request;

class PayslipGenerationController extends Controller
{
    public function index(Request $request)
    {
        $selectedMonth = $request->input('month', date('m'));
        $selectedYear = $request->input('year', date('Y'));



        // Fetch payslip data for the selected month and year
        $payslipData = $this->fetchPayslipDataForMonthAndYear($selectedMonth, $selectedYear);
        $employees  = Employee::all();


        return view('admin.payroll.payslip.index', [
            'payslipData' => $payslipData,
            'selectedMonth' => $selectedMonth,
            'selectedYear' => $selectedYear,
            'employees' => $employees
        ]);
    }


    public function generatePayslips(Request $request)
    {
        // Validate the request
        $request->validate([
            'month' => 'required|date_format:Y-m',
        ]);

        // Get the month from the request
        $month = Carbon::parse($request->month);

        // Fetch all employees
        $employees = Employee::all();

        foreach ($employees as $employee) {
            // Check if a payslip for this month and employee already exists
            $existingPayslip = PayslipGenarate::where('employee_id', $employee->id)
                ->whereYear('month', $month->year)
                ->whereMonth('month', $month->month)
                ->first();

            if (!$existingPayslip) {
                // Create a new payslip for the employee and month
                PayslipGenarate::create([
                    'employee_id' => $employee->id,
                    'month' => $month,
                    'amount_paid' => 0, // Default to 0, since it's not paid yet
                    'paid' => false, // Default to unpaid
                ]);
            }
        }

        return redirect()->route('payslip.index')->with('success', 'Payslips generated for ' . $month->format('F Y'));
    }

    public function markAsPaid($id)
    {
        $payslip = PayslipGenarate::findOrFail($id);

        // Mark the payslip as paid
        $payslip->update(['paid' => true]);

        return redirect()->route('payslip.index')->with('success', 'Payslip marked as paid.');
    }


    public function pay(Request $request, $employeeId)
    {
        // Retrieve the net salary for the specified employee
        $salary = Salary::where('employee_id', $employeeId)->first();

        if (!$salary) {
            return redirect()->back()->with('error', 'Salary not found for the employee');
        }

        // Get the payment month from the form
        $paymentMonth = $request->input('payment_month');

        $payslip = new PayslipGenarate();
        $payslip->employee_id = $employeeId;
        $payslip->month = $paymentMonth; // Assign the payment month
        $payslip->amount_paid = $salary->net_salary;  // Use net salary as the payment amount
        $payslip->paid = true;
        $payslip->save();

        return redirect()->back()->with('success', 'Payment successful');
    }


    public function filterPayslip(Request $request)
{
    $selectedMonth = $request->input('month');
    $selectedYear = $request->input('year');

    // Fetch payslip data for the selected month and year
    $payslipData = $this->fetchPayslipDataForMonthAndYear($selectedMonth, $selectedYear);
    $employees = Employee::all();

    return view('admin.payroll.payslip.index', [
        'payslipData' => $payslipData,
        'selectedMonth' => $selectedMonth,
        'selectedYear' => $selectedYear,
        'employees' => $employees
    ]);
}
    private function fetchPayslipDataForMonthAndYear($month, $year)
        {
            // Fetch payslip data for the selected month and year
            $payslipData = PayslipGenarate::whereYear('month', $year)
                ->whereMonth('month', $month)
                ->get();

            return $payslipData;
        }




}
