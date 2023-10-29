<?php

namespace App\Http\Controllers\Loan;

use App\Http\Controllers\Controller;
use App\Models\Employee;
use App\Models\Loann;
use Illuminate\Http\Request;

class LoannController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function create()
    {
        $employees = Employee::all();
        return view('admin.loans.create', compact('employees'));
    }

    public function store(Request $request)
    {
        // Validate the incoming request
        $request->validate([
            'employee_id' => 'required|exists:employees,id',
            'loan_type' => 'required',
            'amount' => 'required|numeric|min:0',
            'validity' => 'required|integer|min:1',
        ]);

        // Calculate monthly payment based on loan amount and validity
        $monthlyPayment = $request->input('amount') / ($request->input('validity') * 12);

        // Create a new loan with the calculated monthly payment
        Loann::create(array_merge($request->all(), ['monthly_payment' => $monthlyPayment]));

        // Redirect to a success page or return a response
        return redirect()->route('loanns.index')->with('success', 'Loan created successfully.');
    }

    public function index()
    {
        // Fetch all loans with associated employee data from the database
        $loans = Loann::with('employee')->get();

        // Pass the loans data to a view for display
        return view('admin.loans.index', compact('loans'));
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
        //
    }
}
