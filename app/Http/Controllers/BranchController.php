<?php

namespace App\Http\Controllers;

use App\Models\Branch;
use Illuminate\Http\Request;

class BranchController extends Controller
{
    public function index()
    {
        $branches = Branch::all();
        return view('admin.branches.index', compact('branches'));
    }

    public function create()
    {
        return view('admin.branches.create');
    }

    public function store(Request $request)
    {
        // Validate and store branch data
        $data = $request->validate([
            'name' => 'required|string',
            'address' => 'required|string',
            'contact_information' => 'nullable|string',
        ]);

        Branch::create($data);

        return redirect()->route('branches.index')->with('success', 'Branch created successfully');
    }

    public function show($id)
    {
        $branch = Branch::findOrFail($id);
        return view('admin.branches.show', compact('branch'));
    }

    public function edit($id)
    {
        $branch = Branch::findOrFail($id);
        return view('admin.branches.edit', compact('branch'));
    }

    public function update(Request $request, $id)
    {
        $branch = Branch::findOrFail($id);

        // Validate and update branch data
        $data = $request->validate([
            'name' => 'required|string',
            'address' => 'required|string',
            'contact_information' => 'nullable|string',
        ]);

        $branch->update($data);

        return redirect()->route('branches.index')->with('success', 'Branch updated successfully');
    }

    public function destroy($id)
    {
        $branch = Branch::findOrFail($id);
        $branch->delete();

        return redirect()->route('branches.index')->with('success', 'Branch deleted successfully');
    }
}
