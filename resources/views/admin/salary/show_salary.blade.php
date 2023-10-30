@extends('layouts.app')

@section('content')
    <div class="p-6 bg-white rounded-md shadow">
        <h1 class="text-2xl font-semibold mb-4">Salary Information for {{ $employee->name }}</h1>
        <p class="text-gray-600">Employee ID: {{ $employee->id }}</p>

        @if ($employeeSalary)
            <div class="mt-4 mb-8 border border-gray-200 p-4 rounded">
                <h2 class="text-lg font-semibold">Salary Details</h2>
                <div class="grid grid-cols-2 gap-4 mt-4">
                    <div class="space-y-2">
                        <p><span class="font-semibold">Salary Grade:</span> {{ $employeeSalary->salaryGrade->grade_name }}</p>
                        <p><span class="font-semibold">Salary Step:</span> {{ $employeeSalary->salaryStep->step_name }}</p>
                    </div>
                    <div class="space-y-2">
                        <p><span class="font-semibold">Net Salary:</span> ৳{{ $salary_total }}</p>
                    </div>
                </div>

                <h3 class="mt-4 mb-8 text-lg font-semibold">Step Details</h3>
                <ul class="list-disc pl-6 mt-2">
                    <li><span class="font-semibold">Basic Salary:</span> ৳{{ $employeeSalary->salaryStep->basic_salary }}</li>
                    <li><span class="font-semibold">Home Rents:</span> ৳{{ $employeeSalary->salaryStep->home_rents }}</li>
                    <li><span class="font-semibold">Medical Allowance:</span> ৳{{ $employeeSalary->salaryStep->medical_allowance }}</li>
                    <li><span class="font-semibold">Conveyance:</span> ৳{{ $employeeSalary->salaryStep->conveyance }}</li>
                    <li><span class="font-semibold">Lunch:</span> ৳{{ $employeeSalary->salaryStep->lunch }}</li>
                    <li><span class="font-semibold">Mobile:</span> ৳{{ $employeeSalary->salaryStep->mobile }}</li>
                    <li><span class="font-semibold">Special Allowance:</span> ৳{{ $employeeSalary->salaryStep->special_allowance }}</li>
                    <li><span class="font-semibold">Festival Bonus:</span> ৳{{ $employeeSalary->salaryStep->festival_bonus }}</li>
                    <li><span class="font-semibold">Total Salary:</span> ৳{{ $employeeSalary->salaryStep->total_salary }}</li>
                </ul>

                <h3 class="mt-4 text-lg font-semibold">Loans and Deductions</h3>
                <ul class="list-disc pl-6 mt-2">
                    <li><span class="font-semibold">PF Fund:</span> ৳{{ $employeeSalary->salaryStep->pf_fund }}</li>
                    <li><span class="font-semibold">Motorcycle Loan:</span> ৳{{ $motorcycle_loan_total }}</li>
                    <li><span class="font-semibold">PF Loan:</span> ৳{{ $pf_loan_total }}</li>
                    <li><span class="font-semibold">Laptop Loan:</span> ৳{{ $laptop_loan_total }}</li>
                    <li><span class="font-semibold">Staff Welfare:</span> ৳{{ $employeeSalary->salaryStep->staff_welfare }}</li>
                    <li><span class="font-semibold">Tax:</span> ৳{{ $employeeSalary->salaryStep->tax }}</li>
                    <li><span class="font-semibold">Total Deduction:</span> ৳{{ $deduction_total }}</li>
                </ul>
            </div>
        @else
            <p class="mt-4 mb-8 text-red-600">No salary information available for this employee.</p>
        @endif

        <a href="{{ route('set.salary.index') }}" class="bg-blue-500 hover:bg-blue-700 text-white font-semibold py-2 px-4 rounded-full">Back to Salary List</a>
    </div>
@endsection
