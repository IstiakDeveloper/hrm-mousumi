<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Attendance;
use App\Models\Employee;

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
            flash()->error('You are not an employee');
            return redirect()->back();
        }

        $employeeId = $user->employee->id;

        return view('admin.attendances.create', compact('employeeId'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'employee_id' => 'required|exists:employees,id',
            'status' => 'required|in:Present,Absent',
        ]);

        $data = $request->all();

        // Assuming clock_in and clock_out are provided only when the status is 'Present'
        if ($request->status == 'Present') {
            $request->validate([
                'clock_in' => 'required|date_format:H:i:s',
                'clock_out' => 'required|date_format:H:i:s',
            ]);

            // Calculate overtime, late minutes, and early leaving minutes here based on your logic
            // For demonstration purposes, assuming 0 for these fields
            $data['late_minutes'] = 0;
            $data['early_leaving_minutes'] = 0;
            $data['overtime_minutes'] = 0;
        }

        Attendance::create($data);

        return redirect()->route('attendances.index')->with('success', 'Attendance record created successfully.');
    }

    public function show($id)
    {
        $attendance = Attendance::find($id);
        return view('admin.attendances.show', compact('attendance'));
    }

    public function edit($id)
    {
        $attendance = Attendance::find($id);
        return view('admin.attendances.edit', compact('attendance'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'employee_id' => 'required|exists:employees,id',
            'date' => 'required|date',
            'status' => 'required|in:Present,Absent',
            'clock_in' => 'nullable|date_format:H:i:s',
            'clock_out' => 'nullable|date_format:H:i:s',
            'late_minutes' => 'nullable|integer',
            'early_leaving_minutes' => 'nullable|integer',
            'overtime_minutes' => 'nullable|integer',
        ]);

        $attendance = Attendance::find($id);
        $attendance->update($request->all());

        return redirect()->route('attendances.index')->with('success', 'Attendance record updated successfully.');
    }

    public function destroy($id)
    {
        $attendance = Attendance::find($id);
        $attendance->delete();

        return redirect()->route('attendances.index')->with('success', 'Attendance record deleted successfully.');
    }
}
