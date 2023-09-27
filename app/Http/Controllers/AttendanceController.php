<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Attendance;
use App\Models\Employee;
use App\Models\Timesheet;
use Carbon\Carbon;

class AttendanceController extends Controller
{
    public function index()
    {
        $user = auth()->user();

        // Check if the user is an employee
        if ($user->employee) {
            // If the user is an employee, fetch their attendance data
            $employeeId = $user->employee->id;
            $attendances = Attendance::where('employee_id', $employeeId)->get();
        } else {
            // If the user is not an employee (e.g., admin), fetch all attendance data
            $attendances = Attendance::all();
        }

        return view('admin.attendances.index', compact('attendances'));
    }

    public function create()
    {
        $user = auth()->user();

        if (!$user->employee) {
            flash()->error('You are not an employee.');
            return redirect()->back()->with('error', 'You are not an employee');
        }

        $employeeId = $user->employee->id;

        // Get the timesheet data for the current employee
        $timesheet = Timesheet::where('employee_id', $employeeId)->first();

        return view('admin.attendances.create', compact('employeeId', 'timesheet'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'employee_id' => 'required|exists:employees,id',
            'date' => 'required|date',
            'status' => 'required|in:Present,Absent',
            'clock_in' => $request->status == 'Present' ? 'required|date_format:H:i:s' : 'nullable|date_format:H:i:s',
            'clock_out' => $request->status == 'Present' ? 'required|date_format:H:i:s' : 'nullable|date_format:H:i:s',
        ]);

        // Convert the input to integers if they are not null
        $lateMinutes = $request->late_minutes !== null ? (int)$request->late_minutes : 0;
        $earlyLeavingMinutes = $request->early_leaving_minutes !== null ? (int)$request->early_leaving_minutes : 0;

        $attendance = new Attendance();
        $attendance->employee_id = $request->employee_id;
        $attendance->date = $request->date;
        $attendance->status = $request->status;
        $attendance->clock_in = $request->clock_in;
        $attendance->clock_out = $request->clock_out;
        $attendance->late_minutes = $lateMinutes;
        $attendance->early_leaving_minutes = $earlyLeavingMinutes;
        $attendance->overtime_minutes = $request->overtime_minutes ?? 0;

        $attendance->save();

        return redirect()->route('attendances.index')->with('success', 'Attendance record created successfully.');
    }
}
