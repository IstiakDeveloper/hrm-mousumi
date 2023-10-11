@extends('layouts.app')

@section('content')
    <div class="container mx-auto py-8">
        <h1 class="text-3xl font-bold mb-4">Payslips</h1>

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
                        // Retrieve the employee's salary and payslip for the current month
                        $salary = App\Models\Salary::where('employee_id', $employee->id)->first();
                        $payslip = App\Models\PayslipGenarate::where('employee_id', $employee->id)
                                    ->whereMonth('month', now()->month)
                                    ->whereYear('month', now()->year)
                                    ->first();
                    @endphp
                    <tr>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <input type="checkbox" class="pay-checkbox" id="pay-checkbox-{{ $employee->id }}" />
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">{{ $employee->id }}</td>
                        <td class="px-6 py-4 whitespace-nowrap">{{ $employee->name }}</td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            {{ $salary->salary ?? 'N/A' }}
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            {{ $salary->net_salary ?? 'N/A' }}
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            {{ $payslip ? date('F Y', strtotime($payslip->month)) : 'N/A' }}
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            {{ $payslip ? $payslip->amount_paid : 'N/A' }}
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            {{ $payslip && $payslip->paid ? 'Paid' : 'Unpaid' }}
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <form class="pay-form" action="{{ route('pay', ['employeeId' => $employee->id]) }}" method="POST">
                                @csrf
                                <input type="hidden" name="payment_month" value="{{ now()->format('Y-m-d') }}">
                                <button type="submit" class="text-indigo-600 hover:text-indigo-900 pay-button" id="pay-button-{{ $employee->id }}" {{ $payslip && $payslip->paid ? 'disabled' : '' }}>
                                    Pay
                                </button>
                            </form>
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

            const payButtons = [];

            payCheckboxes.forEach(checkbox => {
                const employeeId = checkbox.id.replace('pay-checkbox-', '');
                const payButton = document.getElementById('pay-button-' + employeeId);

                if (payButton) {
                    payButtons.push(payButton);
                }
            });

            payButtons.forEach(button => {
                button.click();
            });
        }






    </script>
@endsection
