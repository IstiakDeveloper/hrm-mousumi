<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Leave;
use App\Models\Employee;
use App\Models\LeaveType;
use Illuminate\Support\Facades\Validator;

class LeaveController extends Controller
{

    public function __construct()
    {
        $this->middleware('department.head')->except(['store', 'create']);
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $user = auth()->user();

        if ($user->isSuperAdmin()) {
            // Super admin can view all employee leaves
            $leaves = Leave::all();
        } elseif ($user->department) {
            // Regular department head view
            $departmentEmployees = $user->department->employees;
            $employeeIds = $departmentEmployees->pluck('id')->toArray();
            $leaves = Leave::whereIn('employee_id', $employeeIds)->get();
        } else {
            flash()->addError('You are not associated with a department');
            return redirect()->back();
        }

        return view('admin.leave.index', compact('leaves'));
    }


    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $user = auth()->user();
        if (!$user->employee) {
            flash()->addError('You are not employee');
            return redirect()->back();
        }

        $employeeId = $user->employee->id;

        $employees = Employee::all();
        $leaveTypes = LeaveType::all();
        return view('admin.leave.create', compact('employees', 'leaveTypes', 'employeeId'));
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'employee_id' => 'required|exists:employees,id',
            'leave_type_id' => 'required|exists:leave_types,id',
            'applied_on' => 'required|date',
            'start_date' => 'required|date',
            'end_date' => 'required|date',
            'total_days' => 'required|integer|min:1',
            'leave_reason' => 'required|string|max:255',
        ]);

        if ($validator->fails()) {
            return redirect()->route('leave.create')
                ->withErrors($validator)
                ->withInput();
        }

        Leave::create($request->all());

        // Update employee's yearly leave balance
        $employee = Employee::findOrFail($request->employee_id);
        $employee->updateYearlyLeaveBalance($request->leave_type_id, -$request->total_days);
        return redirect()->route('leave.index')->with('success', 'Leave application submitted successfully.');
    }

    public function show($id)
    {
        $leave = Leave::findOrFail($id);
        return view('admin.leave.show', compact('leave'));
    }

    public function edit($id)
    {
        $leave = Leave::findOrFail($id);
        $employees = Employee::all();
        $leaveTypes = LeaveType::all();
        return view('admin.leave.edit', compact('leave', 'employees', 'leaveTypes'));
    }

    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'employee_id' => 'required|exists:employees,id',
            'leave_type_id' => 'required|exists:leave_types,id',
            'applied_on' => 'required|date',
            'start_date' => 'required|date',
            'end_date' => 'required|date',
            'total_days' => 'required|integer|min:1',
            'leave_reason' => 'required|string|max:255',
            'status' => 'required|in:Pending,Approved,Rejected',
        ]);

        if ($validator->fails()) {
            return redirect()->route('leave.edit', $id)
                ->withErrors($validator)
                ->withInput();
        }

        $leave = Leave::findOrFail($id);
        $leave->update($request->all());

        // Update employee's yearly leave balance if the leave is approved
        if ($request->status == 'Approved') {
            $employee = Employee::findOrFail($request->employee_id);
            $employee->updateYearlyLeaveBalance($request->leave_type_id, -$request->total_days);
        }

        return redirect()->route('leave.index')->with('success', 'Leave application updated successfully.');
    }

    public function destroy($id)
    {
        $leave = Leave::findOrFail($id);
        $leave->delete();
        return redirect()->route('leave.index')->with('success', 'Leave application deleted successfully.');
    }

}
