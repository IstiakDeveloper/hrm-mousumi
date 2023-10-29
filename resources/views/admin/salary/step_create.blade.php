@extends('layouts.app')
@section('content')
    <div class="container mx-auto mt-10">
        <h2 class="text-2xl font-semibold mb-4">Create Salary Step</h2>
        @if ($errors->any())
            <div class="mt-4">
                <div class="text-red-500 text-sm">
                    Please correct the following errors:
                </div>
                <ul class="list-disc list-inside">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('step.store') }}" method="POST" class="w-full max-w-lg bg-white shadow-md rounded px-8 pt-6 pb-8 mb-4 mx-auto">
            @csrf
            <div class="mb-4">
                <label class="block text-gray-700 text-sm font-bold mb-2" for="salary_grade_id">Select Grade:</label>
                <select name="salary_grade_id" id="salary_grade_id" class="block appearance-none w-full bg-gray-100 border border-gray-400 text-gray-700 py-3 px-4 rounded leading-tight focus:outline-none focus:bg-white focus:border-gray-500 focus:text-gray-900">
                    @foreach($grades as $grade)
                        <option value="{{ $grade->id }}">{{ $grade->grade_name }}</option>
                    @endforeach
                </select>
            </div>
            <div class="mb-4">
                <label class="block text-gray-700 text-sm font-bold mb-2" for="step_name">Name of this step:</label>
                <input type="text" name="step_name" id="step_name" class="block appearance-none w-full bg-gray-100 border border-gray-400 text-gray-700 py-3 px-4 rounded leading-tight focus:outline-none focus:bg-white focus:border-gray-500 focus:text-gray-900" required>
            </div>

            <div class="mb-4">
                <label class="block text-gray-700 text-sm font-bold mb-2" for="basic_salary">Basic Salary:</label>
                <input type="number" name="basic_salary" id="basic_salary" value="{{ old('basic_salary', 0) }}" class="block appearance-none w-full bg-gray-100 border border-gray-400 text-gray-700 py-3 px-4 rounded leading-tight focus:outline-none focus:bg-white focus:border-gray-500 focus:text-gray-900" required>
            </div>

            <div class="border-t border-gray-200 my-4"></div>

            <!-- Allowance Fields -->
            <div class="mb-4">
                <label class="block text-gray-700 text-sm font-bold mb-2">Allowance</label>

                <!-- Medical Allowance -->
                <div class="mb-4">
                    <label class="block text-gray-700 text-sm font-bold mb-2" for="medical_allowance">Medical Allowance:</label>
                    <input type="number" name="medical_allowance" id="medical_allowance" value="{{ old('medical_allowance', 0) }}" class="block appearance-none w-full bg-gray-100 border border-gray-400 text-gray-700 py-3 px-4 rounded leading-tight focus:outline-none focus.bg-white focus:border-gray-500 focus.text-gray-900">
                </div>

                <!-- Lunch -->
                <div class="mb-4">
                    <label class="block text-gray-700 text-sm font-bold mb-2" for="lunch">Lunch:</label>
                    <input type="number" name="lunch" id="lunch" value="{{ old('lunch', 0) }}" class="block appearance-none w-full bg-gray-100 border border-gray-400 text-gray-700 py-3 px-4 rounded leading-tight focus:outline-none focus.bg-white focus:border-gray-500 focus.text-gray-900">
                </div>

                <!-- Mobile -->
                <div class="mb-4">
                    <label class="block text-gray-700 text-sm font-bold mb-2" for="mobile">Mobile:</label>
                    <input type="number" name="mobile" id="mobile" value="{{ old('mobile', 0) }}" class="block appearance-none w-full bg-gray-100 border border-gray-400 text-gray-700 py-3 px-4 rounded leading-tight focus:outline-none focus.bg-white focus:border-gray-500 focus.text-gray-900">
                </div>

                <!-- Special Allowance -->
                <div class="mb-4">
                    <label class="block text-gray-700 text-sm font-bold mb-2" for="special_allowance">Special Allowance:</label>
                    <input type="number" name="special_allowance" id="special_allowance" value="{{ old('special_allowance', 0) }}" class="block appearance-none w-full bg-gray-100 border border-gray-400 text-gray-700 py-3 px-4 rounded leading-tight focus:outline-none focus.bg-white focus:border-gray-500 focus.text-gray-900">
                </div>

                <!-- Festival Bonus -->
                <div class="mb-4">
                    <label class="block text-gray-700 text-sm font-bold mb-2" for="festival_bonus">Festival Bonus:</label>
                    <input type="number" name="festival_bonus" id="festival_bonus" value="{{ old('festival_bonus', 0) }}" class="block appearance-none w-full bg-gray-100 border border-gray-400 text-gray-700 py-3 px-4 rounded leading-tight focus:outline-none focus.bg-white focus:border-gray-500 focus.text-gray-900">
                </div>
            </div>

            <div class="border-t border-gray-200 my-4"></div>

            <!-- Deduction Fields -->
            <div class="mb-4">
                <label class="block text-gray-700 text-sm font-bold mb-2">Deduction</label>

                <!-- Motorcycle Loan -->
                <div class="mb-4">
                    <label class="block text-gray-700 text-sm font-bold mb-2" for="motorcycle_loan">Motorcycle Loan:</label>
                    <input type="number" name="motorcycle_loan" id="motorcycle_loan" value="{{ old('motorcycle_loan', 0) }}" class="block appearance-none w-full bg-gray-100 border border-gray-400 text-gray-700 py-3 px-4 rounded leading-tight focus:outline-none focus.bg-white focus:border-gray-500 focus.text-gray-900">
                </div>

                <!-- PF Loan -->
                <div class="mb-4">
                    <label class="block text-gray-700 text-sm font-bold mb-2" for="pf_loan">PF Loan:</label>
                    <input type="number" name="pf_loan" id="pf_loan" value="{{ old('pf_loan', 0) }}" class="block appearance-none w-full bg-gray-100 border border-gray-400 text-gray-700 py-3 px-4 rounded leading-tight focus:outline-none focus.bg-white focus:border-gray-500 focus.text-gray-900">
                </div>

                <!-- Laptop Loan -->
                <div class="mb-4">
                    <label class="block text-gray-700 text-sm font-bold mb-2" for="laptop_loan">Laptop Loan:</label>
                    <input type="number" name="laptop_loan" id="laptop_loan" value="{{ old('laptop_loan', 0) }}" class="block appearance-none w-full bg-gray-100 border border-gray-400 text-gray-700 py-3 px-4 rounded leading-tight focus:outline-none focus.bg-white focus:border-gray-500 focus.text-gray-900">
                </div>

                <!-- Staff Welfare -->
                <div class="mb-4">
                    <label class="block text-gray-700 text-sm font-bold mb-2" for="staff_welfare">Staff Welfare:</label>
                    <input type="number" name="staff_welfare" id="staff_welfare" value="{{ old('staff_welfare', 0) }}" class="block appearance-none w-full bg-gray-100 border border-gray-400 text-gray-700 py-3 px-4 rounded leading-tight focus:outline-none focus.bg-white focus:border-gray-500 focus.text-gray-900">
                </div>

                <!-- Tax -->
                <div class="mb-4">
                    <label class="block text-gray-700 text-sm font-bold mb-2" for="tax">Tax:</label>
                    <input type="number" name="tax" id="tax" value="{{ old('tax', 0) }}" class="block appearance-none w-full bg-gray-100 border border-gray-400 text-gray-700 py-3 px-4 rounded leading-tight focus:outline-none focus.bg-white focus:border-gray-500 focus.text-gray-900">
                </div>
            </div>

            <div class="flex items-center justify-between">
                <button class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus.shadow-outline" type="submit">Create Step</button>
            </div>
        </form>
    </div>
@endsection
