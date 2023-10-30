@extends('layouts.app')

@section('content')
    <div class="container mx-auto mt-10">
        <h2 class="text-2xl font-semibold text-center mb-4">Create Loan</h2>

        <form action="{{ route('loanns.store') }}" method="POST" class="w-full max-w-lg bg-white shadow-md rounded px-8 pt-6 pb-8 mb-4 mx-auto">
            @csrf

            <div class="mb-4">
                <label class="block text-gray-700 text-sm font-bold mb-2" for="employee_id">Employee:</label>
                <select name="employee_id" id="employee_id" class="block appearance-none w-full bg-gray-100 border border-gray-400 text-gray-700 py-3 px-4 rounded leading-tight focus:outline-none focus:bg-white focus:border-gray-500 focus:text-gray-900" required>
                    <option value="">Select an employee</option>
                    @foreach ($employees as $employee)
                        <option value="{{ $employee->id }}">{{ $employee->name }}</option>
                    @endforeach
                </select>
            </div>

            <div class="mb-4">
                <label class="block text-gray-700 text-sm font-bold mb-2" for="loan_type">Loan Type:</label>
                <select name="loan_type" id="loan_type" class="block appearance-none w-full bg-gray-100 border border-gray-400 text-gray-700 py-3 px-4 rounded leading-tight focus:outline-none focus:bg-white focus:border-gray-500 focus:text-gray-900" required>
                    <option value="motorcycle_loan">Motorcycle Loan</option>
                    <option value="bicycle_loan">Bicycle Loan</option>
                    <option value="pf_loan'">PF Loan</option>
                    <option value="laptop_loan">Laptop Loan</option>
                </select>
            </div>

            <div class="mb-4">
                <label class="block text-gray-700 text-sm font-bold mb-2" for="amount">Loan Amount:</label>
                <input type="number" name="amount" id="amount" class="block appearance-none w-full bg-gray-100 border border-gray-400 text-gray-700 py-3 px-4 rounded leading-tight focus:outline-none focus:bg-white focus:border-gray-500 focus:text-gray-900" required>
            </div>

            <div class="mb-4">
                <label class="block text-gray-700 text-sm font-bold mb-2" for="validity">Loan Validity (in years):</label>
                <input type="number" name="validity" id="validity" class="block appearance-none w-full bg-gray-100 border border-gray-400 text-gray-700 py-3 px-4 rounded leading-tight focus:outline-none focus:bg-white focus:border-gray-500 focus:text-gray-900" required>
            </div>

            <!-- The monthly payment is automatically calculated based on the loan amount and validity -->

            <div class="flex items-center justify-between">
                <button class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline" type="submit">Create Loan</button>
            </div>
        </form>
    </div>
@endsection
