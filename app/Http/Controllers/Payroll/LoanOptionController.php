<?php

namespace App\Http\Controllers\Payroll;

use App\Http\Controllers\Controller;
use App\Models\LoanOption;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class LoanOptionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $loanOptions = LoanOption::all();
        return view('admin.payroll.loan_options.index', compact('loanOptions'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.payroll.loan_options.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'loan_option' => 'required|string|max:255',
        ]);

        if ($validator->fails()) {
            return redirect()->route('loan_options.create')
                ->withErrors($validator)
                ->withInput();
        }
        LoanOption::create($request->all());

        return redirect()->route('loan_options.index')->with('success', 'Loan option created successfully.');
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
        $loanOption = LoanOption::findOrFail($id);
        $loanOption->delete();
        return redirect()->route('loan_options.index')->with('success', 'Loan option deleted successfully.');
    }
}
