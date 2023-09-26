<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Timesheet;
use App\Models\Employee;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Validator;

class TimesheetController extends Controller
{
    public function index()
    {
        $timesheets = Timesheet::all();
        return view('admin.timesheets.index', compact('timesheets'));
    }

    public function create()
    {
        $employees = Employee::all();
        return view('admin.timesheets.create', compact('employees'));
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'employee_id' => 'required|exists:employees,id',
            'date' => 'required|date',
            'office_start' => 'required|date_format:H:i',
            'office_end' => 'required|date_format:H:i|after:office_start',
            'remark' => 'nullable|string|max:255'
        ]);

        if ($validator->fails()) {
            return redirect()->route('timesheets.create')
                ->withErrors($validator)
                ->withInput();
        }

        $hoursWorked = $this->calculateHoursWorked($request->office_start, $request->office_end);

        Timesheet::create([
            'employee_id' => $request->employee_id,
            'date' => $request->date,
            'office_start' => $request->office_start,
            'office_end' => $request->office_end,
            'hours_worked' => $hoursWorked,
            'remark' => $request->remark,
        ]);

        return redirect()->route('timesheets.index')->with('success', 'Timesheet entry created successfully.');
    }

    private function calculateHoursWorked($officeStart, $officeEnd)
    {
        $startTime = Carbon::parse($officeStart);
        $endTime = Carbon::parse($officeEnd);
        $hoursWorked = $endTime->diffInHours($startTime) + ($endTime->diffInMinutes($startTime) % 60) / 60;
        return $hoursWorked;
    }

    public function edit($id)
    {
        $timesheet = Timesheet::findOrFail($id);
        $employees = Employee::all();
        return view('admin.timesheets.edit', compact('timesheet', 'employees'));
    }

    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'employee_id' => 'required|exists:employees,id',
            'date' => 'required|date',
            'office_start' => 'required|date_format:H:i',
            'office_end' => 'required|date_format:H:i|after:office_start',
            'remark' => 'nullable|string|max:255'
        ]);

        if ($validator->fails()) {
            return redirect()->route('timesheets.edit', $id)
                ->withErrors($validator)
                ->withInput();
        }

        $hoursWorked = $this->calculateHoursWorked($request->office_start, $request->office_end);

        $timesheet = Timesheet::findOrFail($id);
        $timesheet->update([
            'employee_id' => $request->employee_id,
            'date' => $request->date,
            'office_start' => $request->office_start,
            'office_end' => $request->office_end,
            'hours_worked' => $hoursWorked,
            'remark' => $request->remark,
        ]);

        return redirect()->route('timesheets.index')->with('success', 'Timesheet entry updated successfully.');
    }

    public function destroy($id)
    {
        $timesheet = Timesheet::findOrFail($id);
        $timesheet->delete();

        return redirect()->route('timesheets.index')->with('success', 'Timesheet entry deleted successfully.');
    }
}
