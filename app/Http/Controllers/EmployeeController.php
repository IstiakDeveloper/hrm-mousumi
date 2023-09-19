<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;
use App\Models\Employee;
use App\Models\Branch;
use App\Models\Department;
use App\Models\Designation;
use App\Models\User;
use PDF;
use Dompdf\Dompdf;
use Dompdf\Options;
use Spatie\Permission\Models\Role;

class EmployeeController extends Controller
{
    public function index()
    {
        $employees = Employee::all(); // Adjust query as needed
        return view('admin.employees.index', compact('employees'));
    }

    public function create()
    {
        // Generate employee ID
        $generatedEmployeeID = $this->generateEmployeeID();

        // Load the create view and pass the required data
        return view('admin.employees.create', [
            'generatedEmployeeID' => $generatedEmployeeID,
            'branches' => Branch::all(),
            'departments' => Department::all(),
            'designations' => Designation::all(),
        ]);
    }

    public function store(Request $request)
    {
        // Validate and store employee data
        $data = $request->validate([
            'name' => 'required|string',
            'phone' => 'required|string',
            'date_of_birth' => 'required|date',
            'gender' => 'required|string',
            'email' => 'required|email|unique:employees,email',
            'password' => 'required|string',
            'address' => 'required|string',
            'branch_id' => 'required|exists:branches,id',
            'department_id' => 'required|exists:departments,id',
            'designation_id' => 'required|exists:designations,id',
            'date_of_joining' => 'required|date',
            'certificate' => 'nullable|file|mimes:pdf', // Updated validation for file
            'resume' => 'nullable|file|mimes:pdf,doc,docx', // Updated validation for file
            'photo' => 'nullable|file|image|mimes:jpeg,png,jpg,gif', // Updated validation for image
            'account_holder_name' => 'nullable|string',
            'account_number' => 'nullable|string',
            'bank_name' => 'nullable|string',
            'branch_location' => 'nullable|string',
            'swift_code' => 'nullable|string',
        ]);

        // Generate employee ID
        $generatedEmployeeID = $this->generateEmployeeID();

        $employee = Employee::create(array_merge($data, [
            'employee_id' => $generatedEmployeeID,
        ]));

        if (!$employee) {
            return redirect()->route('employees.create')->with('error', 'Failed to create employee. Please try again.');
        }

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password),
        ]);

        // Assign the 'employee' role to the user
        $employeeRole = Role::firstOrCreate(['name' => 'employee']);
        $user->assignRole($employeeRole);

        if ($request->roles) {
            $user->assignRole($request->roles);
        }



        // Handle file uploads (certificate, resume, photo) if provided
        if ($request->hasFile('certificate')) {
            $certificatePath = $request->file('certificate')->store('certificates', 'public');
            $data['certificate'] = $certificatePath;
        }

        if ($request->hasFile('resume')) {
            $resumePath = $request->file('resume')->store('resumes', 'public');
            $data['resume'] = $resumePath;
        }

        if ($request->hasFile('photo')) {
            $photoPath = $request->file('photo')->store('photos', 'public');
            $data['photo'] = $photoPath;
        }
        return redirect()->route('employees.index')->with('success', 'Employee created successfully')->with('generatedEmployeeID', $generatedEmployeeID);
    }


    // Define your own logic for generating employee IDs
    private function generateEmployeeID()
    {
        // Get the current maximum employee ID from the database
        $maxEmployeeID = Employee::max('employee_id');

        // Extract the numeric part and increment it
        $numericPart = (int)substr($maxEmployeeID, 3); // Extract the numeric part and convert to an integer
        $newNumericPart = $numericPart + 1;

        // Format the new numeric part with leading zeros
        $formattedNumericPart = str_pad($newNumericPart, 6, '0', STR_PAD_LEFT);

        // Create the new employee ID
        $newEmployeeID = 'EMP' . $formattedNumericPart;

        return $newEmployeeID;
    }


    public function show(Employee $employee)
    {
        return view('admin.employees.show', compact('employee'));
    }

    public function download($id)
    {
        $employee = Employee::find($id);

        // Load the PDF view and pass the employee data
        $pdf = PDF::loadView('admin.employees.pdf', compact('employee'));

        // Generate a unique PDF file name with the employee's ID
        $pdfFileName = 'emp_' . $employee->employee_id . '.pdf';

        // Set the Content-Disposition header with the desired file name
        $headers = [
            'Content-Disposition' => 'attachment; filename="' . $pdfFileName . '"',
        ];

        return $pdf->download($pdfFileName, $headers);
    }



    public function edit(Employee $employee)
    {
        $branches = Branch::all();
        $departments = Department::all();
        $designations = Designation::all();

        return view('admin.employees.edit', compact('employee', 'branches', 'departments', 'designations'));
    }
    public function update(Request $request, Employee $employee)
    {
        // Validate and update employee data
        $data = $request->validate([
            'name' => 'required|string',
            'phone' => 'required|string',
            'date_of_birth' => 'required|date',
            'gender' => 'required|string',
            'email' => 'required|email|unique:employees,email,' . $employee->id, // Exclude the current employee's email from unique validation
            'address' => 'required|string',
            'branch_id' => 'required|exists:branches,id',
            'department_id' => 'required|exists:departments,id',
            'designation_id' => 'required|exists:designations,id',
            'date_of_joining' => 'required|date',
            'certificate' => 'nullable|file|mimes:pdf', // Updated validation for file
            'resume' => 'nullable|file|mimes:pdf,doc,docx', // Updated validation for file
            'photo' => 'nullable|file|image|mimes:jpeg,png,jpg,gif', // Updated validation for image
            'account_holder_name' => 'nullable|string',
            'account_number' => 'nullable|string',
            'bank_name' => 'nullable|string',
            'branch_location' => 'nullable|string',
            'swift_code' => 'nullable|string',
        ]);

        // Handle file uploads (certificate, resume, photo) if provided
       // Handle file uploads (certificate, resume, photo) if provided
       if ($request->hasFile('certificate')) {
        $certificatePath = $request->file('certificate')->store('certificates', 'public');
        $data['certificate'] = $certificatePath;
        }

        if ($request->hasFile('resume')) {
            $resumePath = $request->file('resume')->store('resumes', 'public');
            $data['resume'] = $resumePath;
        }

        if ($request->hasFile('photo')) {
            $photoPath = $request->file('photo')->store('photos', 'public');
            $data['photo'] = $photoPath;
        }


        // Handle bank account details if provided

        // Check if a new password is provided
        if ($request->filled('password')) {
            $data['password'] = bcrypt($request->input('password'));
        }

        // Update the employee data in the database
        $employee->update($data);

        return redirect()->route('employees.index')->with('success', 'Employee updated successfully');
    }


    public function destroy(Employee $employee)
    {
        // Delete the employee
        $employee->delete();

        return redirect()->route('employees.index')->with('success', 'Employee deleted successfully');
    }
}
