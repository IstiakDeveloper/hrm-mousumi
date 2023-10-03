<?php

namespace App\Http\Controllers\Payroll;

use App\Http\Controllers\Controller;
use App\Models\AllowanceOption;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class AllowanceOptionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $allowanceOptions = AllowanceOption::all();
        return view('admin.payroll.allowance_options.index', compact('allowanceOptions'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.payroll.allowance_options.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'allowance_option' => 'required|string|max:255',
        ]);

        if ($validator->fails()) {
            return redirect()->route('allowance_options.create')
                ->withErrors($validator)
                ->withInput();
        }
        AllowanceOption::create($request->all());

        return redirect()->route('allowance_options.index')->with('success', 'Allowance option created successfully.');
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
        $allowanceOption = AllowanceOption::findOrFail($id);
        $allowanceOption->delete();
        return redirect()->route('allowance_options.index')->with('success', 'Allowance option deleted successfully.');
    }
}
