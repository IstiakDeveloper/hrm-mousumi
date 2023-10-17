<?php

namespace App\Http\Controllers\Job;

use App\Http\Controllers\Controller;
use App\Models\Job;
use App\Models\JobApplication;
use Illuminate\Http\Request;
use PDF;

class JobApplicationController extends Controller
{
    public function applyForm($jobId)
    {
        $job = Job::findOrFail($jobId);
        return view('admin.recruitments.careers.apply', compact('job'));
   }

   public function apply(Request $request, $jobId)
   {
       // Validate the incoming request data
       $request->validate([
           'name' => 'required|string|max:255',
           'email' => 'required|email|max:255',
           'phone' => 'required|string|max:15',
           'cover_letter' => 'nullable|string',
           'date_of_birth' => 'required|date',
           'address' => 'required|string|max:255',
           'gender' => 'required|string|max:255',
           'profile_image' => 'nullable|image|mimes:jpeg,png,jpg,gif',
           'resume' => 'nullable|file|mimes:pdf,doc,docx|max:2048',
           'job_id' => 'required|exists:jobs,id'
       ]);

       // Upload profile image if provided
       $profileImagePath = null;
       if ($request->hasFile('profile_image')) {
           $profileImagePath = $request->file('profile_image')->store('profile_images', 'public');
       }

       // Upload resume if provided
       $resumePath = null;
       if ($request->hasFile('resume')) {
           $resumePath = $request->file('resume')->store('application-resumes', 'public');
       }

       // Create a new job application for the given job
       $jobApplication = new JobApplication([
           'name' => $request->input('name'),
           'email' => $request->input('email'),
           'phone' => $request->input('phone'),
           'cover_letter' => $request->input('cover_letter'),
           'date_of_birth' => $request->input('date_of_birth'),
           'gender' => $request->input('gender'),
           'address' => $request->input('address'),
           'profile_image' => $profileImagePath,
           'resume' => $resumePath,
           'job_id' => $request->input('job_id'),
       ]);

       $jobApplication->save();

       return redirect()->route('jobs.show', $jobId)->with('success', 'Job application submitted successfully!');
   }



   public function viewJobApplications()
    {
        $jobApplications = JobApplication::all();  // Fetch all job applications

        return view('admin.recruitments.job_applications.index', ['jobApplications' => $jobApplications]);
    }

    public function showJobApplication($id)
    {
        // Get the job application by ID
        $jobApplication = JobApplication::findOrFail($id);

        // Assuming you want to display a specific job application
        return view('admin.recruitments.job_applications.show', ['jobApplication' => $jobApplication]);
    }
    public function downloadPDF($id)
    {
        $jobApplication = JobApplication::findOrFail($id);

        // Generate PDF content
        $pdfContent = view('admin.recruitments.job_applications.pdf', compact('jobApplication'))->render();

        // Generate the PDF using Laravel PDF facade
        $pdf = PDF::loadHTML($pdfContent);

        return $pdf->stream('job_application_' . $jobApplication->id . '.pdf');
    }

}
