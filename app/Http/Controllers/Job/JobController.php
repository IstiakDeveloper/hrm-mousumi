<?php

namespace App\Http\Controllers\Job;

use App\Http\Controllers\Controller;
use App\Models\Branch;
use App\Models\Job;
use App\Models\JobCategory;
use Illuminate\Http\Request;

class JobController extends Controller
{
    public function index()
    {
        $jobs = Job::all();
        return view('admin.recruitments.jobs.index', compact('jobs'));
    }

    public function create()
    {
        $branches = Branch::all();
        $jobCategories = JobCategory::all();
        return view('admin.recruitments.jobs.create', compact('jobCategories', 'branches'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'branch' => 'required|string|max:255',
            'job_category_id' => 'required|exists:job_categories,id',
            'number_of_positions' => 'required|integer',
            'status' => 'required|in:Active,Inactive',
            'start_date' => 'required|date',
            'end_date' => 'required|date',
            'skills' => 'required|string',
            'gender' => 'required|string',
            'dob_required' => 'required|boolean',
            'address_required' => 'required|boolean',
            'profile_image_required' => 'required|boolean',
            'resume_required' => 'required|boolean',
            'cover_letter_required' => 'required|boolean',
            'description' => 'required|string',
            'requirements' => 'required|string',
        ]);

        Job::create($request->all());

        return redirect()->route('jobs.index')->with('success', 'Job created successfully.');
    }

    public function edit(Job $job)
    {
        $branches = Branch::all();
        $jobCategories = JobCategory::all();
        return view('admin.recruitments.jobs.edit', compact('job', 'jobCategories', 'branches'));
    }

    public function update(Request $request, Job $job)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'branch' => 'required|string|max:255',
            'job_category_id' => 'required|exists:job_categories,id',
            'number_of_positions' => 'required|integer',
            'status' => 'required|in:Active,Inactive',
            'start_date' => 'required|date',
            'end_date' => 'required|date',
            'skills' => 'required|string',
            'gender' => 'required|string',
            'dob_required' => 'required|boolean',
            'address_required' => 'required|boolean',
            'profile_image_required' => 'required|boolean',
            'resume_required' => 'required|boolean',
            'cover_letter_required' => 'required|boolean',
            'description' => 'required|string',
            'requirements' => 'required|string',
        ]);

        $job->update($request->all());

        return redirect()->route('jobs.index')->with('success', 'Job updated successfully.');
    }

    public function destroy(Job $job)
    {
        $job->delete();
        return redirect()->route('jobs.index')->with('success', 'Job deleted successfully.');
    }


    // For show all jobs
    public function showAllJobs()
    {
        $jobs = Job::all();
        return view('admin.recruitments.careers.index', compact('jobs'));
    }

    public function jobShow($id) {
        $branches = Branch::all();
        $jobCategories = JobCategory::all();
        $job = Job::findOrFail($id);
        return view('admin.recruitments.careers.show', compact('job', 'jobCategories', 'branches'));
    }


}
