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
        $attendances = Attendance::all();
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

        $attendance = new Attendance();
        $attendance->employee_id = $request->employee_id;
        $attendance->date = $request->date;
        $attendance->status = $request->status;
        $attendance->clock_in = $request->clock_in;
        $attendance->clock_out = $request->clock_out;

        if ($request->status == 'Present' && $request->clock_in && $request->clock_out) {
            $timesheet = Timesheet::where('employee_id', $request->employee_id)->first();

            if ($timesheet) {
                $attendance->late_minutes = max(0, $this->calculateLateMinutes($timesheet->office_start, $request->clock_in));
                $attendance->early_leaving_minutes = max(0, $this->calculateEarlyLeavingMinutes($timesheet->office_end, $request->clock_out));
                $attendance->overtime_minutes = max(0, $this->calculateOvertimeMinutes($timesheet->office_start, $timesheet->office_end, $request->clock_out));
            }
        } else {
            $attendance->late_minutes = 0;
            $attendance->early_leaving_minutes = 0;
            $attendance->overtime_minutes = 0;
        }

        $attendance->save();

        return redirect()->route('attendances.index')->with('success', 'Attendance record created successfully.');
    }


    private function calculateLateMinutes($officeStart, $clockIn)
    {
        if (!$officeStart || !$clockIn) {
            return 0;
        }

        // Convert times to Carbon instances for easier calculations
        $officeStartTime = Carbon::parse($officeStart);
        $clockInTime = Carbon::parse($clockIn);

        // Calculate late minutes
        $lateMinutes = $clockInTime->diffInMinutes($officeStartTime, false);

        // If clock in is earlier than office start time, consider it as on time (0 late minutes)
        return max(0, $lateMinutes);
    }

    private function calculateEarlyLeavingMinutes($officeEnd, $clockOut)
    {
        if (!$officeEnd || !$clockOut) {
            return 0;
        }

        // Convert times to Carbon instances for easier calculations
        $officeEndTime = Carbon::parse($officeEnd);
        $clockOutTime = Carbon::parse($clockOut);

        // Calculate early leaving minutes
        $earlyLeavingMinutes = $clockOutTime->diffInMinutes($officeEndTime, false);

        // If clock out is later than office end time, consider it as on time (0 early leaving minutes)
        return max(0, $earlyLeavingMinutes);
    }

    private function calculateOvertimeMinutes($officeStart, $officeEnd, $clockOut)
    {
        if (!$officeStart || !$officeEnd || !$clockOut) {
            return 0;
        }

        $officeStartTime = Carbon::parse($officeStart);
        $officeEndTime = Carbon::parse($officeEnd);
        $clockOutTime = Carbon::parse($clockOut);

        $overtimeMinutes = max(0, $clockOutTime->diffInMinutes($officeEndTime, false));

        // If clock out is earlier than office start time, consider it as on time (0 overtime minutes)
        if ($overtimeMinutes > 0) {
            $overtimeMinutes = max(0, $clockOutTime->diffInMinutes($officeStartTime, false));
        }

        return $overtimeMinutes;
    }


}
