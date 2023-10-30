@extends('layouts.app')

@section('content')
    <div class="container mx-auto mt-5 p-6 bg-white rounded-lg shadow-lg">
        <h1 class="text-2xl font-semibold mb-4">Employee List</h1>
        <div class="overflow-x-auto">
            <table class="min-w-full">
                <thead>
                    <tr>
                        <th class="px-6 py-3 border-b-2 border-gray-300 text-left leading-4 text-blue-500 tracking-wider">Name</th>
                        <th class="px-6 py-3 border-b-2 border-gray-300 text-left leading-4 text-blue-500 tracking-wider">Salary Grade</th>
                        <th class="px-6 py-3 border-b-2 border-gray-300 text-left leading-4 text-blue-500 tracking-wider">Salary Step</th>
                        <th class="px-6 py-3 border-b-2 border-gray-300 text-left leading-4 text-blue-500 tracking-wider">Basic Salary</th>
                        <th class="px-6 py-3 border-b-2 border-gray-300 text-left leading-4 text-blue-500 tracking-wider">Home Rents</th>
                        <th class="px-6 py-3 border-b-2 border-gray-300 text-left leading-4 text-blue-500 tracking-wider">Medical Allowance</th>
                        <th class="px-6 py-3 border-b-2 border-gray-300 text-left leading-4 text-blue-500 tracking-wider">Conveyance</th>
                        <th class="px-6 py-3 border-b-2 border-gray-300 text-left leading-4 text-blue-500 tracking-wider">Lunch</th>
                        <th class="px-6 py-3 border-b-2 border-gray-300 text-left leading-4 text-blue-500 tracking-wider">Mobile</th>
                        <th class="px-6 py-3 border-b-2 border-gray-300 text-left leading-4 text-blue-500 tracking-wider">Special Allowance</th>
                        <th class="px-6 py-3 border-b-2 border-gray-300 text-left leading-4 text-blue-500 tracking-wider">Festival Bonus</th>
                        <th class="px-6 py-3 border-b-2 border-gray-300 text-left leading-4 text-blue-500 tracking-wider">Total Salary</th>
                        <th class="px-6 py-3 border-b-2 border-gray-300 text-left leading-4 text-blue-500 tracking-wider">PF Fund</th>
                        <th class="px-6 py-3 border-b-2 border-gray-300 text-left leading-4 text-blue-500 tracking-wider">Motorcycle Loan</th>
                        <th class="px-6 py-3 border-b-2 border-gray-300 text-left leading-4 text-blue-500 tracking-wider">PF Loan</th>
                        <th class="px-6 py-3 border-b-2 border-gray-300 text-left leading-4 text-blue-500 tracking-wider">Laptop Loan</th>
                        <th class="px-6 py-3 border-b-2 border-gray-300 text-left leading-4 text-blue-500 tracking-wider">Staff Welfare</th>
                        <th class="px-6 py-3 border-b-2 border-gray-300 text-left leading-4 text-blue-500 tracking-wider">Tax</th>
                        <th class="px-6 py-3 border-b-2 border-gray-300 text-left leading-4 text-blue-500 tracking-wider">Total Deduction</th>
                        <th class="px-6 py-3 border-b-2 border-gray-300 text-left leading-4 text-blue-500 tracking-wider">Net Salary</th>
                        <th class="px-6 py-3 border-b-2 border-gray-300 text-left leading-4 text-blue-500 tracking-wider">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($salaryData as $data)
                    <tr>
                        <td class="px-6 py-4 whitespace-no-wrap border-b border-gray-300">{{ $data['employee']->name }}</td>
                        @if ($data['employeeSalary'])
                            <td class="px-6 py-4 whitespace-no-wrap border-b border-gray-300">{{ $data['employeeSalary']->salaryGrade->grade_name }}</td>
                            <td class="px-6 py-4 whitespace-no-wrap border-b border-gray-300">{{ $data['employeeSalary']->salaryStep->step_name }}</td>
                            <td class="px-6 py-4 whitespace-no-wrap border-b border-gray-300">৳{{ $data['employeeSalary']->salaryStep->basic_salary }}</td>
                            <td class="px-6 py-4 whitespace-no-wrap border-b border-gray-300">৳{{ $data['employeeSalary']->salaryStep->home_rents }}</td>
                            <td class="px-6 py-4 whitespace-no-wrap border-b border-gray-300">৳{{ $data['employeeSalary']->salaryStep->medical_allowance }}</td>
                            <td class="px-6 py-4 whitespace-no-wrap border-b border-gray-300">৳{{ $data['employeeSalary']->salaryStep->conveyance }}</td>
                            <td class="px-6 py-4 whitespace-no-wrap border-b border-gray-300">৳{{ $data['employeeSalary']->salaryStep->lunch }}</td>
                            <td class="px-6 py-4 whitespace-no-wrap border-b border-gray-300">৳{{ $data['employeeSalary']->salaryStep->mobile }}</td>
                            <td class="px-6 py-4 whitespace-no-wrap border-b border-gray-300">৳{{ $data['employeeSalary']->salaryStep->special_allowance }}</td>
                            <td class="px-6 py-4 whitespace-no-wrap border-b border-gray-300">৳{{ $data['employeeSalary']->salaryStep->festival_bonus }}</td>
                            <td class="px-6 py-4 whitespace-no-wrap border-b border-gray-300">৳{{ $data['employeeSalary']->salaryStep->total_salary }}</td>
                            <td class="px-6 py-4 whitespace-no-wrap border-b border-gray-300">৳{{ $data['employeeSalary']->salaryStep->pf_fund }}</td>
                            <td class="px-6 py-4 whitespace-no-wrap border-b border-gray-300">৳{{ $data['motorcycle_loan_total'] }}</td>
                            <td class="px-6 py-4 whitespace-no-wrap border-b border-gray-300">৳{{ $data['pf_loan_total'] }}</td>
                            <td class="px-6 py-4 whitespace-no-wrap border-b border-gray-300">৳{{ $data['laptop_loan_total'] }}</td>
                            <td class="px-6 py-4 whitespace-no-wrap border-b border-gray-300">৳{{ $data['employeeSalary']->salaryStep->staff_welfare }}</td>
                            <td class="px-6 py-4 whitespace-no-wrap border-b border-gray-300">৳{{ $data['employeeSalary']->salaryStep->tax }}</td>
                            <td class="px-6 py-4 whitespace-no-wrap border-b border-gray-300">৳{{ $data['deduction_total'] }}</td>
                            <td class="px-6 py-4 whitespace-no-wrap border-b border-gray-300">৳{{ $data['salary_total'] }}</td>
                        @else
                            <td class="px-6 py-4 whitespace-no-wrap border-b border-gray-300">N/A</td>
                            <td class="px-6 py-4 whitespace-no-wrap border-b border-gray-300">N/A</td>
                            <td class="px-6 py-4 whitespace-no-wrap border-b border-gray-300">N/A</td>
                            <td class="px-6 py-4 whitespace-no-wrap border-b border-gray-300">N/A</td>
                            <td class="px-6 py-4 whitespace-no-wrap border-b border-gray-300">N/A</td>
                            <td class="px-6 py-4 whitespace-no-wrap border-b border-gray-300">N/A</td>
                            <td class="px-6 py-4 whitespace-no-wrap border-b border-gray-300">N/A</td>
                            <td class="px-6 py-4 whitespace-no-wrap border-b border-gray-300">N/A</td>
                            <td class="px-6 py-4 whitespace-no-wrap border-b border-gray-300">N/A</td>
                            <td class="px-6 py-4 whitespace-no-wrap border-b border-gray-300">N/A</td>
                            <td class="px-6 py-4 whitespace-no-wrap border-b border-gray-300">N/A</td>
                            <td class="px-6 py-4 whitespace-no-wrap border-b border-gray-300">N/A</td>
                            <td class="px-6 py-4 whitespace-no-wrap border-b border-gray-300">N/A</td>
                            <td class="px-6 py-4 whitespace-no-wrap border-b border-gray-300">N/A</td>
                            <td class="px-6 py-4 whitespace-no-wrap border-b border-gray-300">N/A</td>
                            <td class="px-6 py-4 whitespace-no-wrap border-b border-gray-300">N/A</td>
                            <td class="px-6 py-4 whitespace-no-wrap border-b border-gray-300">N/A</td>
                            <td class="px-6 py-4 whitespace-no-wrap border-b border-gray-300">N/A</td>
                        @endif
                        <td class="px-6 py-4 whitespace-no-wrap border-b border-gray-300">
                            @if ($data['employee']->employeeSalary)
                                <a href="{{ route('employee.showSalary', $data['employee']->id) }}" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded-full"><i class="fa-solid fa-eye"></i></a>

                            @else
                                <a href="{{ route('employee.setSalary', $data['employee']->id) }}" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded-full"><i class="fa-solid fa-plus"></i></a>
                            @endif
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

    </div>
@endsection
