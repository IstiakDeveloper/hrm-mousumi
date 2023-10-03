<?php

namespace App\Http\Controllers\Payroll;

use App\Http\Controllers\Controller;
use App\Models\PayslipType;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class PayslipTypeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $payslipTypes = PayslipType::all();
        return view('admin.payroll.payslip_types.index', compact('payslipTypes'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.payroll.payslip_types.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'payslip_type' => 'required|string|max:255',
        ]);

        if ($validator->fails()) {
            return redirect()->route('payslip_types.create')
                ->withErrors($validator)
                ->withInput();
        }
        PayslipType::create($request->all());

        return redirect()->route('payslip_types.index')->with('success', 'Payslip type created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $payslipType = PayslipType::findOrFail($id);
        $payslipType->delete();
        return redirect()->route('loan_options.index')->with('success', 'Loan option deleted successfully.');
    }
}
