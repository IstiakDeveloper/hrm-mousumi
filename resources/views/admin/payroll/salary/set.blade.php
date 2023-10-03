@extends('layouts.app')

@section('content')
<style>
    /* Your existing styles... */

    /* Additional styles for the modal content */
    .modal-content {
        padding: 1rem;
    }

    .modal-content label {
        display: block;
        margin-bottom: 0.5rem;
    }

    .modal-content input,
    .modal-content select {
        width: 100%;
        padding: 0.5rem;
        margin-bottom: 1rem;
        border: 1px solid #ccc;
        border-radius: 0.25rem;
    }
</style>
<div class="container mx-auto p-6">
    <h1 class="text-3xl font-bold mb-6">Set Salary for {{ $employee->name }}</h1>

    <!-- Employee Information -->
    <div class="mb-6">
        <h3 class="text-xl font-bold mb-3">Employee Information</h3>
        <p class="mb-3"><span class="font-semibold">Employee Name:</span> {{ $employee->name }}</p>
        <!-- Display other employee information as needed -->

        <h3 class="text-xl font-bold mb-3">Salary Information</h3>
        @if (isset($salary) && $salary)
            <p><span class="font-semibold">Payroll Type:</span> {{ $salary->payroll_type }}</p>
            <p><span class="font-semibold">Salary:</span> {{ $salary->salary }}</p>
            <p><span class="font-semibold">Net Salary:</span> {{ $salary->net_salary }}</p>
            <!-- Display other salary-related information -->
        @else
            <p>No salary information available for this employee.</p>
        @endif
    </div>

    <div class="flex flex-wrap mb-6">
        <!-- Payslip Option -->
        <div class="w-full md:w-1/2 px-3 mb-6">
            <h3 class="text-xl font-bold mb-3">Payslips</h3>
            <button class="btn btn-primary mb-3" onclick="toggleModal('payslipModal')">Create Payslip</button>
            <ul>
                <!-- Display existing payslips -->
                @if ($employee->payslips)
                    @foreach($employee->payslips as $payslip)
                        <li>{{ $payslip->payroll_type }} - {{ $payslip->salary }}</li>
                    @endforeach
                @else
                    <p>No payslips available for this employee.</p>
                @endif
            </ul>
        </div>

        <!-- Allowance Option -->
        <div class="w-full md:w-1/2 px-3 mb-6">
            <h3 class="text-xl font-bold mb-3">Allowances</h3>
            <button class="btn btn-primary mb-3" onclick="toggleModal('allowanceModal')">Create Allowance</button>
            <ul>
                @if ($employee->allowances)
                    <!-- Display existing allowances -->
                    @foreach($employee->allowances as $allowance)
                        <li>{{ $allowance->allowance_option->name }} - {{ $allowance->amount }}</li>
                    @endforeach
                @else
                    <p>No allowances available for this employee.</p>
                @endif
            </ul>
        </div>
    </div>

    <div class="flex flex-wrap mb-6">
        <!-- Deduction Option -->
        <div class="w-full md:w-1/2 px-3 mb-6">
            <h3 class="text-xl font-bold mb-3">Deductions</h3>
            <button class="btn btn-primary mb-3" onclick="toggleModal('deductionModal')">Create Deduction</button>
            <ul>
                @if ($employee->deductions && $employee->deductions()->count() > 0)
                    <!-- Display existing deductions -->
                    @foreach($employee->deductions as $deduction)
                        <li>{{ $deduction->deduction_option->name }} - {{ $deduction->amount }}</li>
                    @endforeach
                @else
                    <p>No deductions available for this employee.</p>
                @endif
            </ul>
        </div>

        <!-- Loan Option -->
        <div class="w-full md:w-1/2 px-3 mb-6">
            <h3 class="text-xl font-bold mb-3">Loans</h3>
            <button class="btn btn-primary mb-3" onclick="toggleModal('loanModal')">Create Loan</button>
            <ul>
                @if ($employee->loans && $employee->loans()->count() > 0)
                    <!-- Display existing loans -->
                    @foreach($employee->loans as $loan)
                        <li>{{ $loan->loan_option->name }} - {{ $loan->amount }}</li>
                    @endforeach
                @else
                    <p>No loans available for this employee.</p>
                @endif
            </ul>
        </div>
    </div>

    <!-- Modals -->
    <!-- Payslip Modal -->
    <div id="payslipModal" class="modal fixed hidden inset-0 flex items-center justify-center z-50">
        <div class="modal-overlay absolute w-full h-full bg-gray-900 opacity-50"></div>
        <div class="modal-container bg-white w-11/12 md:max-w-md mx-auto rounded shadow-lg z-50 overflow-y-auto">
            <div class="modal-content py-4 text-left px-6">
                <div class="flex justify-between items-center pb-3">
                    <p class="text-2xl font-bold">Create Payslip</p>
                    <button onclick="toggleModal('payslipModal')" class="modal-close">
                        <svg class="fill-current text-black" xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 18 18">
                            <path d="M6.293 6.293a1 1 0 011.414 0L9 7.586l1.293-1.293a1 1 0 111.414 1.414L10.414 9l1.293 1.293a1 1 0 11-1.414 1.414L9 10.414l-1.293 1.293a1 1 0 01-1.414-1.414L7.586 9 6.293 7.707a1 1 0 010-1.414z"/>
                        </svg>
                    </button>
                </div>

                <!-- Modal body for Payslip -->
                <div class="flex flex-col space-y-2">
                    <label for="payroll_type">Payroll Type:</label>
                    <input type="text" id="payroll_type" class="border rounded p-2">

                    <label for="salary">Salary:</label>
                    <input type="text" id="salary" class="border rounded p-2">

                    <label for="net_salary">Net Salary:</label>
                    <input type="text" id="net_salary" class="border rounded p-2">
                </div>
            </div>
        </div>
    </div>

    <!-- Allowance Modal -->
    <div id="allowanceModal" class="modal fixed hidden inset-0 flex items-center justify-center z-50">
        <div class="modal-overlay absolute w-full h-full bg-gray-900 opacity-50"></div>
        <div class="modal-container bg-white w-11/12 md:max-w-md mx-auto rounded shadow-lg z-50 overflow-y-auto">
            <div class="modal-content py-4 text-left px-6">
                <div class="flex justify-between items-center pb-3">
                    <p class="text-2xl font-bold">Create Allowance</p>
                    <button onclick="toggleModal('allowanceModal')" class="modal-close">
                        <svg class="fill-current text-black" xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 18 18">
                            <path d="M6.293 6.293a1 1 0 011.414 0L9 7.586l1.293-1.293a1 1 0 111.414 1.414L10.414 9l1.293 1.293a1 1 0 11-1.414 1.414L9 10.414l-1.293 1.293a1 1 0 01-1.414-1.414L7.586 9 6.293 7.707a1 1 0 010-1.414z"/>
                        </svg>
                    </button>
                </div>

                <!-- Modal body for Allowance -->
                <div class="flex flex-col space-y-2">
                    <label for="allowance_name">Allowance Name:</label>
                    <input type="text" id="allowance_name" class="border rounded p-2">

                    <label for="allowance_amount">Amount:</label>
                    <input type="text" id="allowance_amount" class="border rounded p-2">

                    <label for="allowance_option">Allowance Option:</label>
                    <select id="allowance_option" class="border rounded p-2">
                        <!-- Add options dynamically based on your data -->
                        <option value="option1">Option 1</option>
                        <option value="option2">Option 2</option>
                        <!-- Add more options as needed -->
                    </select>
                </div>
            </div>
        </div>
    </div>

    <!-- Deduction Modal -->
    <div id="deductionModal" class="modal fixed hidden inset-0 flex items-center justify-center z-50">
        <div class="modal-overlay absolute w-full h-full bg-gray-900 opacity-50"></div>
        <div class="modal-container bg-white w-11/12 md:max-w-md mx-auto rounded shadow-lg z-50 overflow-y-auto">
            <div class="modal-content py-4 text-left px-6">
                <div class="flex justify-between items-center pb-3">
                    <p class="text-2xl font-bold">Create Deduction</p>
                    <button onclick="toggleModal('deductionModal')" class="modal-close">
                        <svg class="fill-current text-black" xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 18 18">
                            <path d="M6.293 6.293a1 1 0 011.414 0L9 7.586l1.293-1.293a1 1 0 111.414 1.414L10.414 9l1.293 1.293a1 1 0 11-1.414 1.414L9 10.414l-1.293 1.293a1 1 0 01-1.414-1.414L7.586 9 6.293 7.707a1 1 0 010-1.414z"/>
                        </svg>
                    </button>
                </div>

                <!-- Modal body for Deduction -->
                <div class="flex flex-col space-y-2">
                    <label for="deduction_name">Deduction Name:</label>
                    <input type="text" id="deduction_name" class="border rounded p-2">

                    <label for="deduction_amount">Amount:</label>
                    <input type="text" id="deduction_amount" class="border rounded p-2">

                    <label for="deduction_option">Deduction Option:</label>
                    <select id="deduction_option" class="border rounded p-2">
                        <!-- Add options dynamically based on your data -->
                        <option value="option1">Option 1</option>
                        <option value="option2">Option 2</option>
                        <!-- Add more options as needed -->
                    </select>
                </div>
            </div>
        </div>
    </div>

    <!-- Loan Modal -->
    <div id="loanModal" class="modal fixed hidden inset-0 flex items-center justify-center z-50">
        <div class="modal-overlay absolute w-full h-full bg-gray-900 opacity-50"></div>
        <div class="modal-container bg-white w-11/12 md:max-w-md mx-auto rounded shadow-lg z-50 overflow-y-auto">
            <div class="modal-content py-4 text-left px-6">
                <div class="flex justify-between items-center pb-3">
                    <p class="text-2xl font-bold">Create Loan</p>
                    <button onclick="toggleModal('loanModal')" class="modal-close">
                        <svg class="fill-current text-black" xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 18 18">
                            <path d="M6.293 6.293a1 1 0 011.414 0L9 7.586l1.293-1.293a1 1 0 111.414 1.414L10.414 9l1.293 1.293a1 1 0 11-1.414 1.414L9 10.414l-1.293 1.293a1 1 0 01-1.414-1.414L7.586 9 6.293 7.707a1 1 0 010-1.414z"/>
                        </svg>
                    </button>
                </div>

                <!-- Modal body for Loan -->
                <div class="flex flex-col space-y-2">
                    <label for="loan_name">Loan Name:</label>
                    <input type="text" id="loan_name" class="border rounded p-2">

                    <label for="loan_amount">Amount:</label>
                    <input type="text" id="loan_amount" class="border rounded p-2">

                    <label for="loan_option">Loan Option:</label>
                    <select id="loan_option" class="border rounded p-2">
                        <!-- Add options dynamically based on your data -->
                        <option value="option1">Option 1</option>
                        <option value="option2">Option 2</option>
                        <!-- Add more options as needed -->
                    </select>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
function toggleModal(modalId) {
    const modal = document.getElementById(modalId);
    modal.classList.toggle('hidden');
    modal.classList.toggle('flex');
}

// Add event listener to close the modal when the overlay is clicked
const overlay = document.querySelectorAll('.modal-overlay');
overlay.forEach((element) => {
    element.addEventListener('click', (e) => {
        if (e.target === element) {
            const modalId = element.parentElement.getAttribute('id');
            toggleModal(modalId);
        }
    });
});

// Add event listener to close the modal when the close button is clicked
const closeButtons = document.querySelectorAll('.modal-close');
closeButtons.forEach((button) => {
    button.addEventListener('click', () => {
        const modalId = button.parentElement.parentElement.getAttribute('id');
        toggleModal(modalId);
    });
});
</script>

@endsection
