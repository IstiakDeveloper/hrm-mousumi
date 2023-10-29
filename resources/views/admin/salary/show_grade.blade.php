@extends('layouts.app')

@section('content')
    <div class="container mx-auto mt-10">
        <h2 class="text-2xl font-semibold mb-4">Grade Details: {{ $grade->grade_name }}</h2>

        <a href="{{ route('salary.index') }}" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded mb-4 inline-block">Back to Grades</a>

        <div class="bg-white p-4 rounded shadow">
            <h3 class="text-lg font-semibold mb-2">Grade Name: {{ $grade->grade_name }}</h3>
            <p class="mb-2">Total Steps: {{ count($steps) }}</p>
        </div>

        <div class="mt-4">
            <h3 class="text-xl font-semibold mb-2">Steps</h3>
            <a href="{{ route('step.create') }}" class="bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded mb-4 inline-block">Create Step</a>
            <div class="overflow-x-auto">
                <table class="min-w-full">
                    <thead>
                        <tr>
                            <th class="px-4 py-2 bg-gray-800 text-white text-center text-xs font-medium uppercase" colspan="9">Allowance</th>
                            <th class="px-4 py-2 bg-gray-800 text-white text-center text-xs font-medium uppercase" colspan="9">Deduction</th>
                        </tr>
                        <tr>
                            <th class="px-4 py-2 bg-gray-800 text-white text-left text-xs font-medium uppercase">Step Name</th>
                            <th class="px-4 py-2 bg-gray-800 text-white text-left text-xs font-medium uppercase">Basic Salary</th>
                            <th class="px-4 py-2 bg-gray-800 text-white text-left text-xs font-medium uppercase">Home Rents</th>
                            <th class="px-4 py-2 bg-gray-800 text-white text-left text-xs font-medium uppercase">Medical Allowance</th>
                            <th class="px-4 py-2 bg-gray-800 text-white text-left text-xs font-medium uppercase">Conveyance</th>
                            <th class="px-4 py-2 bg-gray-800 text-white text-left text-xs font-medium uppercase">Lunch</th>
                            <th class="px-4 py-2 bg-gray-800 text-white text-left text-xs font-medium uppercase">Mobile</th>
                            <th class="px-4 py-2 bg-gray-800 text-white text-left text-xs font-medium uppercase">Special Allowance</th>
                            <th class="px-4 py-2 bg-gray-800 text-white text-left text-xs font-medium uppercase">Festival Bonus</th>
                            <th class="px-4 py-2 bg-gray-800 text-white text-left text-xs font-medium uppercase">Total Salary</th>
                            <th class="px-4 py-2 bg-gray-800 text-white text-left text-xs font-medium uppercase">PF Fund</th>
                            <th class="px-4 py-2 bg-gray-800 text-white text-left text-xs font-medium uppercase">Motorcycle Loan</th>
                            <th class="px-4 py-2 bg-gray-800 text-white text-left text-xs font-medium uppercase">PF Loan</th>
                            <th class="px-4 py-2 bg-gray-800 text-white text-left text-xs font-medium uppercase">Laptop Loan</th>
                            <th class="px-4 py-2 bg-gray-800 text-white text-left text-xs font-medium uppercase">Staff Welfare</th>
                            <th class="px-4 py-2 bg-gray-800 text-white text-left text-xs font-medium uppercase">Tax</th>
                            <th class="px-4 py-2 bg-gray-800 text-white text-left text-xs font-medium uppercase">Total Deduction</th>
                            <th class="px-4 py-2 bg-gray-800 text-white text-left text-xs font-medium uppercase">Net Salary</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($steps as $step)
                            <tr class="bg-white hover:bg-gray-100 border-b border-gray-200">
                                <td class="px-4 py-2">{{ $step->step_name }}</td>
                                <td class="px-4 py-2">৳{{ $step->basic_salary }}</td>
                                <td class="px-4 py-2">৳{{ $step->home_rents }}</td>
                                <td class="px-4 py-2">৳{{ $step->medical_allowance }}</td>
                                <td class="px-4 py-2">৳{{ $step->conveyance }}</td>
                                <td class="px-4 py-2">৳{{ $step->lunch }}</td>
                                <td class="px-4 py-2">৳{{ $step->mobile }}</td>
                                <td class="px-4 py-2">৳{{ $step->special_allowance }}</td>
                                <td class="px-4 py-2">৳{{ $step->festival_bonus }}</td>
                                <td class="px-4 py-2">৳{{ $step->total_salary }}</td>
                                <td class="px-4 py-2">৳{{ $step->pf_fund }}</td>
                                <td class="px-4 py-2">৳{{ $step->motorcycle_loan }}</td>
                                <td class="px-4 py-2">৳{{ $step->pf_loan }}</td>
                                <td class="px-4 py-2">৳{{ $step->laptop_loan }}</td>
                                <td class="px-4 py-2">৳{{ $step->staff_welfare }}</td>
                                <td class="px-4 py-2">৳{{ $step->tax }}</td>
                                <td class="px-4 py-2">৳{{ $step->total_deduction }}</td>
                                <td class="px-4 py-2">৳{{ $step->net_salary }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
