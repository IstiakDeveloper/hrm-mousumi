@extends('layouts.app')

@section('content')
    <div class="container mx-auto mt-10">
        <h2 class="text-2xl font-semibold mb-4">Loan Listing</h2>

        <table class="min-w-full bg-white shadow-md rounded overflow-hidden">
            <thead class="bg-gray-800 text-white">
                <tr>
                    <th class="px-4 py-2">Employee</th>
                    <th class="px-4 py-2">Loan Type</th>
                    <th class="px-4 py-2">Loan Amount</th>
                    <th class="px-4 py-2">Validity (Years)</th>
                    <th class="px-4 py-2">Monthly Payment</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($loans as $loan)
                    <tr>
                        <td class="px-4 py-2 text-center">{{ $loan->employee->name }}</td>
                        <td class="px-4 py-2 text-center">{{ $loan->loan_type }}</td>
                        <td class="px-4 py-2 text-center">{{ $loan->amount }}</td>
                        <td class="px-4 py-2 text-center">{{ $loan->validity }}</td>
                        <td class="px-4 py-2 text-center">{{ $loan->monthly_payment }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
