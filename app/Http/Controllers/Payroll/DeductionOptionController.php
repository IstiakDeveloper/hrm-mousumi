<?php

namespace App\Http\Controllers\Payroll;

use App\Http\Controllers\Controller;
use App\Models\DeductionOption;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class DeductionOptionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $deductionOptions = DeductionOption::all();
        return view('admin.payroll.deduction_options.index', compact('deductionOptions'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.payroll.deduction_options.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'deduction_option' => 'required|string|max:255',
        ]);

        if ($validator->fails()) {
            return redirect()->route('deduction_options.create')
                ->withErrors($validator)
                ->withInput();
        }
        DeductionOption::create($request->all());

        return redirect()->route('deduction_options.index')->with('success', 'Deduction option created successfully.');
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
        $deductionOption = DeductionOption::findOrFail($id);
        $deductionOption->delete();
        return redirect()->route('deduction_options.index')->with('success', 'Deduction option deleted successfully.');
    }
}
