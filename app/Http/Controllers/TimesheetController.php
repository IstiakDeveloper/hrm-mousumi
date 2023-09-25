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
            'clock_in' => 'required|date_format:H:i',
            'clock_out' => 'required|date_format:H:i|after:clock_in',
            'remark' => 'nullable|string|max:255'
        ]);

        if ($validator->fails()) {
            return redirect()->route('timesheets.create')
                ->withErrors($validator)
                ->withInput();
        }

        $clockIn = Carbon::parse($request->clock_in);
        $clockOut = Carbon::parse($request->clock_out);
        $hoursWorked = $clockOut->diffInHours($clockIn) + ($clockOut->diffInMinutes($clockIn) % 60) / 60;

        Timesheet::create([
            'employee_id' => $request->employee_id,
            'date' => $request->date,
            'hours_worked' => $hoursWorked,
            'remark' => $request->remark,
        ]);

        return redirect()->route('timesheets.index')->with('success', 'Timesheet entry created successfully.');
    }

    public function show($id)
    {
        $timesheet = Timesheet::findOrFail($id);
        return view('admin.timesheets.show', compact('timesheet'));
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
            'clock_in' => 'required|date_format:H:i',
            'clock_out' => 'required|date_format:H:i|after:clock_in',
            'remark' => 'nullable|string|max:255'
        ]);

        if ($validator->fails()) {
            return redirect()->route('timesheets.edit', $id)
                ->withErrors($validator)
                ->withInput();
        }

        $clockIn = Carbon::parse($request->clock_in);
        $clockOut = Carbon::parse($request->clock_out);
        $hoursWorked = $clockOut->diffInHours($clockIn) + ($clockOut->diffInMinutes($clockIn) % 60) / 60;

        $timesheet = Timesheet::findOrFail($id);
        $timesheet->update([
            'employee_id' => $request->employee_id,
            'date' => $request->date,
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
