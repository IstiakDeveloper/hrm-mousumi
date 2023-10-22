<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use App\Models\Job;
use App\Models\Leave;
use App\Models\Payslip;
use App\Models\Timesheet;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller

{
    public function index()
    {
        $employeeCount = Employee::count();
        $timesheetCount = Timesheet::count();
        $payslipCount = Payslip::count();
        $jobCount = Job::count();
        $openJobCount = Job::where('status', 'Active')->count();
        $closeJobCount = Job::where('status', 'Inactive')->count();
        $leaveCount = Leave::count();
        $pendingLeaveCount = Leave::where('status', 'Pending')->count();
        $approveLeaveCount = Leave::where('status', 'Approved')->count();
        $rejectLeaveCount = Leave::where('status', 'Rejected')->count();

        return view('admin.dashboard', compact('employeeCount', 'timesheetCount', 'payslipCount', 'openJobCount', 'leaveCount', 'pendingLeaveCount', 'approveLeaveCount', 'rejectLeaveCount', 'jobCount', 'openJobCount', 'closeJobCount' ));

    }
}
