<?php

namespace App\Http\Controllers\Payroll;

use App\Http\Controllers\Controller;
use App\Models\Employee;
use App\Models\Payslip;
use Illuminate\Http\Request;

class PayslipController extends Controller
{
    public function index(Request $request)
    {
        $currentYear = date('Y');
        $currentMonth = date('m');

        $selectedYear = $request->input('year', $currentYear);
        $selectedMonth = $request->input('month', $currentMonth);

        // Fetch employees with default status as not paid
        $employees = Employee::all();

        return view('admin.payroll.payslip.index', compact('employees', 'selectedYear', 'selectedMonth'));
    }


}
