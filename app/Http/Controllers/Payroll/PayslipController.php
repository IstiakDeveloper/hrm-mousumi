<?php

namespace App\Http\Controllers\Payroll;

use App\Http\Controllers\Controller;
use App\Models\Employee;
use App\Models\Payslip;
use Illuminate\Http\Request;

class PayslipController extends Controller
{
    public function generatePayslip($employeeId)
    {
        // Fetch employee details and payslip info
        $employee = Employee::findOrFail($employeeId);
        $payslip = Payslip::where('employee_id', $employeeId)->orderBy('created_at', 'desc')->first();

        // Determine payslip status
        $isPaid = $payslip && $payslip->status === 'paid';

        return view('admin.payslip.generate', compact('employee', 'payslip', 'isPaid'));
    }

    public function index()
    {
        $years = Payslip::selectRaw('YEAR(created_at) as year')->distinct()->pluck('year');
        $months = Payslip::selectRaw('MONTH(created_at) as month')->distinct()->pluck('month');
        $payslips = Payslip::all();

        return view('admin.payroll.payslip.index', compact('years', 'months', 'payslips'));


    }


}
