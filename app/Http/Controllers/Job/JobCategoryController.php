<?php

namespace App\Http\Controllers\Job;

use App\Http\Controllers\Controller;
use App\Models\JobCategory;
use Illuminate\Http\Request;

class JobCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $jobCategories = JobCategory::all();
        return view('admin.recruitments.job_categories.index', compact('jobCategories'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.recruitments.job_categories.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255|unique:job_categories',
        ]);

        JobCategory::create([
            'name' => $request->input('name'),
        ]);

        return redirect()->route('job_categories.index')->with('success', 'Job category created successfully.');
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
        $jobCategory = JobCategory::findOrFail($id);
        return view('admin.recruitments.job_categories.edit', compact('jobCategory'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'name' => 'required|string|max:255|unique:job_categories,name,' . $id,
        ]);

        $jobCategory = JobCategory::findOrFail($id);
        $jobCategory->update([
            'name' => $request->input('name'),
        ]);

        return redirect()->route('job_categories.index')->with('success', 'Job category updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $jobCategory = JobCategory::findOrFail($id);
        $jobCategory->delete();

        return redirect()->route('job_categories.index')->with('success', 'Job category deleted successfully.');
    }
}
