@extends('layouts.app')

@section('content')
    <div class="container mx-auto py-8">

        <form id="filterForm" action="{{ route('filter.payslip') }}" method="GET" class="flex items-center space-x-4">
            <div class="flex items-center space-x-2">
                <label for="month" class="font-bold">Month:</label>
                <select name="month" id="month" class="border p-2 rounded">
                    @for ($i = 1; $i <= 12; $i++)
                        <option value="{{ $i }}" {{ $i == $selectedMonth ? 'selected' : '' }}>
                            {{ date('F', mktime(0, 0, 0, $i, 1)) }}
                        </option>
                    @endfor
                </select>
            </div>

            <div class="flex items-center space-x-2">
                <label for="year" class="font-bold">Year:</label>
                <select name="year" id="year" class="border p-2 rounded">
                    @php
                        $currentYear = date('Y');
                        $startYear = $currentYear - 5;
                        $endYear = $currentYear;
                    @endphp

                    @for ($year = $startYear; $year <= $endYear; $year++)
                        <option value="{{ $year }}" {{ $year == $selectedYear ? 'selected' : '' }}>
                            {{ $year }}
                        </option>
                    @endfor
                </select>
            </div>

            <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                <i class="fas fa-filter mr-2"></i> Filter
            </button>
        </form>



        <h2 class="text-2xl font-bold mt-8 mb-4">
            Payslips for {{ date('F Y', mktime(0, 0, 0, $selectedMonth, 1, $selectedYear)) }}
        </h2>

        <button type="button" class="bg-indigo-500 hover:bg-indigo-700 text-white font-bold py-2 px-4 rounded mb-6" id="pay-selected-button" style="display: none;" onclick="paySelected()">
            Pay Selected
        </button>
        <table class="min-w-full divide-y divide-gray-200">
            <thead class="bg-gray-50">
                <tr>
                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                        <input type="checkbox" id="checkAll" onchange="toggleAllCheckboxes()">
                    </th>
                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                        ID
                    </th>
                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                        Employee Name
                    </th>
                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                        Salary
                    </th>
                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                        Net Salary
                    </th>
                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                        Month
                    </th>
                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                        Amount Paid
                    </th>
                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                        Status
                    </th>
                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                        Actions
                    </th>
                </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-200">
                @foreach($employees as $employee)
                    @php
                        $salary = App\Models\Salary::where('employee_id', $employee->id)->first();

                        // Check if payslip data is available for the selected month
                        $payslip = $payslipData->where('employee_id', $employee->id)->first();
                        $status = $payslip ? ($payslip->paid ? 'Paid' : 'Unpaid') : 'Unpaid';
                        $amountPaid = $payslip ? $payslip->amount_paid : 'N/A';
                        $month = $payslip ? date('F Y', strtotime($payslip->month)) : 'N/A';
                    @endphp
                    <tr>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <input type="checkbox" class="pay-checkbox" id="pay-checkbox-{{ $employee->id }}" />
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">{{ $employee->employee_id }}</td>
                        <td class="px-6 py-4 whitespace-nowrap">{{ $employee->name }}</td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            {{ $salary->salary ?? 'N/A' }}
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            {{ $salary->net_salary ?? 'N/A' }}
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            {{ $month }}
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            {{ $amountPaid }}
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            {{ $status }}
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                                <div class="flex items-center">
                                    <form class="pay-form mr-2" action="{{ route('pay', ['employeeId' => $employee->id]) }}" method="POST">
                                        @csrf
                                        <input type="hidden" name="payment_month" value="{{ $selectedYear }}-{{ str_pad($selectedMonth, 2, '0', STR_PAD_LEFT) }}-01">
                                        <button type="submit" class="text-indigo-600 hover:text-indigo-900 pay-button" id="pay-button-{{ $employee->id }}" {{ $payslip && $payslip->paid ? 'disabled' : '' }}>
                                            Pay
                                        </button>
                                    </form>
                                    @if ($status == 'Paid')
                                    <a href="#" class="text-indigo-600 hover:text-indigo-900 px-4 py-2 border border-indigo-600 rounded">
                                        <i class="fas fa-file-pdf text-lg"></i>
                                    </a>
                                    @endif
                                </div>

                        </td>

                    </tr>
                @endforeach
            </tbody>


        </table>
    </div>
    <script>
        function toggleAllCheckboxes() {
            const checkAllCheckbox = document.getElementById('checkAll');
            const payCheckboxes = document.querySelectorAll('.pay-checkbox');

            payCheckboxes.forEach(checkbox => {
                checkbox.checked = checkAllCheckbox.checked;
            });

            togglePayButton();
        }

        function togglePayButton() {
            const payCheckboxes = document.querySelectorAll('.pay-checkbox');
            const paySelectedButton = document.getElementById('pay-selected-button');
            let atLeastOneChecked = false;

            payCheckboxes.forEach(checkbox => {
                if (checkbox.checked) {
                    atLeastOneChecked = true;
                }
            });

            if (atLeastOneChecked) {
                paySelectedButton.style.display = 'block';
            } else {
                paySelectedButton.style.display = 'none';
            }
        }

        function paySelected() {
            const payCheckboxes = document.querySelectorAll('.pay-checkbox:checked');

            if (payCheckboxes.length === 0) {
                alert('No items selected for payment.');
                return;
            }

            const selectedMonth = document.getElementById('month').value;
            const selectedYear = document.getElementById('year').value;

            const payButtons = [];

            payCheckboxes.forEach(checkbox => {
                const employeeId = checkbox.id.replace('pay-checkbox-', '');
                const payButton = document.getElementById('pay-button-' + employeeId);

                if (payButton) {
                    // Add selected month and year to the form
                    const form = payButton.closest('form');
                    const paymentMonthInput = document.createElement('input');
                    paymentMonthInput.type = 'hidden';
                    paymentMonthInput.name = 'payment_month';
                    paymentMonthInput.value = `${selectedYear}-${selectedMonth}-01`;

                    form.appendChild(paymentMonthInput);
                    payButtons.push(payButton);
                }
            });

            payButtons.forEach(button => {
                button.click();
            });
        }


    </script>
@endsection
