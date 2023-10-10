@extends('layouts.app')
@section('content')

<div class="max-w-md mx-auto">
    <h1 class="text-2xl font-bold mb-4">Generate Payslips</h1>

    <form action="{{ route('payslip.generate') }}" method="GET" class="space-y-4">
        <div class="flex space-x-2">
            <label for="year" class="flex-1">Select Year:</label>
            <select name="year" id="year" class="flex-2 border rounded p-2">
                <option value="" disabled selected>Select Year</option>
                @foreach ($years as $year)
                    <option value="{{ $year }}">{{ $year }}</option>
                @endforeach
            </select>
        </div>

        <div class="flex space-x-2">
            <label for="month" class="flex-1">Select Month:</label>
            <select name="month" id="month" class="flex-2 border rounded p-2">
                <option value="" disabled selected>Select Month</option>
                @foreach ($months as $month)
                    <option value="{{ $month }}">{{ date('F', mktime(0, 0, 0, $month, 10)) }}</option>
                @endforeach
            </select>
        </div>

        <button type="submit" class="btn btn-primary">Generate Payslips</button>
    </form>

    <h1 class="text-2xl font-bold mb-4">Payslips for {{ date('F', mktime(0, 0, 0, $month, 10)) }} {{ $year }}</h1>

    <table class="min-w-full">
        <thead>
            <tr>
                <th>Employee ID</th>
                <th>Name</th>
                <th>Payroll Type</th>
                <th>Salary</th>
                <th>Net Salary</th>
                <th>Status</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($payslips as $payslip)
                <tr>
                    <td>{{ $payslip->employee_id }}</td>
                    <td>{{ $payslip->employee->name }}</td>
                    <td>{{ $payslip->payroll_type }}</td>
                    <td>{{ $payslip->basic_salary }}</td>
                    <td>{{ $payslip->net_salary }}</td>
                    <td>{{ $payslip->status }}</td>
                    <td>
                        @if ($payslip->status == 'unpaid')
                            <button class="btn btn-primary">Generate Payslip</button>
                        @else
                            <button class="btn btn-success">Paid</button>
                            <button class="btn btn-info">Edit</button>
                        @endif
                        <button class="btn btn-danger">Delete</button>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>

<script>
    function updateMonths() {
        const selectedYear = document.getElementById('year').value;
        const monthSelect = document.getElementById('month');

        // Clear existing options
        monthSelect.innerHTML = '';

        if (selectedYear) {
            // Populate months based on the selected year
            const months = ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'];

            months.forEach((month, index) => {
                const option = document.createElement('option');
                option.value = index + 1;  // Month numbers are 1-based
                option.textContent = month;
                monthSelect.appendChild(option);
            });
        }
    }
    </script>
@endsection
