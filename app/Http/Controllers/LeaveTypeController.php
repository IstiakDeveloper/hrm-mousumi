<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\LeaveType;
use Illuminate\Support\Facades\Validator;

class LeaveTypeController extends Controller
{
    public function index()
    {
        $leaveTypes = LeaveType::all();
        return view('admin.leave_types.index', compact('leaveTypes'));
    }

    public function create()
    {
        return view('admin.leave_types.create');
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'leave_type' => 'required|string|max:255',
            'day' => 'required|integer|min:0',
        ]);

        if ($validator->fails()) {
            return redirect()->route('leave-types.create')
                ->withErrors($validator)
                ->withInput();
        }

        LeaveType::create($request->all());

        return redirect()->route('leave_types.index')->with('success', 'Leave type created successfully.');
    }

    public function show($id)
    {
        $leaveType = LeaveType::findOrFail($id);
        return view('admin.leave_types.show', compact('leaveType'));
    }

    public function edit($id)
    {
        $leaveType = LeaveType::findOrFail($id);
        return view('admin.leave_types.edit', compact('leaveType'));
    }

    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'leave_type' => 'required|string|max:255',
            'day' => 'required|integer|min:0',
        ]);

        if ($validator->fails()) {
            return redirect()->route('leave_types.edit', $id)
                ->withErrors($validator)
                ->withInput();
        }

        $leaveType = LeaveType::findOrFail($id);
        $leaveType->update($request->all());

        return redirect()->route('leave_types.index')->with('success', 'Leave type updated successfully.');
    }

    public function destroy($id)
    {
        $leaveType = LeaveType::findOrFail($id);
        $leaveType->delete();
        return redirect()->route('leave_types.index')->with('success', 'Leave type deleted successfully.');
    }
}

