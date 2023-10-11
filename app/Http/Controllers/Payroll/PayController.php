<?php

namespace App\Http\Controllers;

use App\Models\Pay;
use App\Models\Employee;
use App\Models\Payslip;
use Illuminate\Http\Request;

class PayController extends Controller
{
    public function create($employee_id, $month)
    {
        // Retrieve the employee and payslip information for the given month
        $employee = Employee::findOrFail($employee_id);
        $payslip = Payslip::where('employee_id', $employee_id)
                          ->where('month', $month)
                          ->first();

        return view('pay.create', compact('employee', 'payslip'));
    }

    public function store(Request $request)
    {
        // Validate the request
        $request->validate([
            'employee_id' => 'required|exists:employees,id',
            'month' => 'required|date_format:Y-m',
            'amount_paid' => 'required|numeric|min:0',
        ]);

        // Check if a payslip for the specified month exists
        $payslip = Payslip::where('employee_id', $request->employee_id)
                          ->where('month', $request->month)
                          ->first();

        if ($payslip) {
            // Update the payslip with the amount paid and set the status to paid
            $payslip->amount_paid = $request->amount_paid;
            $payslip->paid = true;
            $payslip->save();

            return redirect()->route('payslip.index')->with('success', 'Payment recorded successfully.');
        }

        return redirect()->route('payslip.index')->with('error', 'Payslip for the specified month not found.');
    }
}
