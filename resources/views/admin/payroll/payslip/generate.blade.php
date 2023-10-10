@extends('layouts.app')

@section('content')
<div class="max-w-md mx-auto">
    <h1 class="text-2xl font-bold mb-4">Generate Payslips</h1>

    @if(count($payslips) > 0)
        <table class="min-w-full bg-white border border-gray-300">
            <thead>
                <tr>
                    <th class="py-2 px-4 border-b">Employee Name</th>
                    <th class="py-2 px-4 border-b">Salary</th>
                    <th class="py-2 px-4 border-b">Net Salary</th>
                    <!-- Add more headers as needed -->
                </tr>
            </thead>
            <tbody>
                @foreach ($payslips as $payslip)
                    <tr>
                        <td class="py-2 px-4 border-b">{{ $payslip->employee->name }}</td>
                        <td class="py-2 px-4 border-b">{{ $payslip->basic_salary }}</td>
                        <td class="py-2 px-4 border-b">{{ $payslip->net_salary }}</td>
                        <!-- Add more data cells as needed -->
                    </tr>
                @endforeach
            </tbody>
        </table>
    @else
        <p>No payslips available for the selected year and month.</p>
    @endif
</div>
@endsection
