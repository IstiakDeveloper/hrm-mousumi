@extends('layouts.app')

@section('content')
<style>
        .btn {
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            color: white;
            cursor: pointer;
            font-weight: bold;
            transition: background-color 0.3s ease;
        }

        .btn-primary {
            background-color: #3490dc; /* Blue */
        }

        .btn-secondary {
            background-color: #38a169; /* Green */
        }

        .btn-success {
            background-color: #6b46c1; /* Purple */
        }

        .btn:hover {
            opacity: 0.8;
        }
</style>
    <div class="container mx-auto p-6">
        <h1 class="text-3xl font-bold mb-6">Set Salary for {{ $employee->name }}</h1>
    <!-- Employee Information -->
    <div class="mb-6">
        <h3 class="text-xl font-bold mb-3">Employee Information</h3>
        <p class="mb-3"><span class="font-semibold">Employee Name:</span> {{ $employee->name }}</p>
        <h3 class="text-xl font-bold mb-3">Salary Information</h3>
        @if (isset($salary) && $salary)
            <p><span class="font-semibold">Payroll Type:</span> {{ $salary->payslip_type }}</p>
            <p><span class="font-semibold">Salary:</span> {{ $salary->salary }}</p>
            <p><span class="font-semibold">Net Salary:</span> {{ $salary->net_salary }}</p>

            @if ($salary->payslipType)
            <p><span class="font-semibold">Payslip Type:</span> {{ $salary->payslipType->payslip_type }}</p>
            @else
                <p><span class="font-semibold">Payslip Type:</span> Not defined for this salary.</p>
            @endif
        @else
            <p>No salary information available for this employee.</p>
        @endif
    </div>

    <div class="flex flex-wrap mb-6">
        <!-- Payslip Option -->
        <div class="w-full md:w-1/2 px-3 mb-6">
            <h3 class="text-xl font-bold mb-3">Payslips</h3>
            <button class="btn btn-primary mb-3" onclick="toggleModal('payslipModal')">
                <i class="fas fa-plus"></i>
            </button>


            <table class="min-w-full bg-white border border-gray-300">
                <thead>
                    <tr>
                        <th class="py-2 px-4">Payroll Type</th>
                        <th class="py-2 px-4">Basic Salary</th>
                        <th class="py-2 px-4">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @if ($employee->payslips->count() > 0)
                    @foreach($employee->payslips as $payslip)
                        <tr>
                            <td class="text-center py-2 px-4">{{ $payslip->payslip_type->payslip_type }}</td>
                            <td class="text-center py-2 px-4">{{ $payslip->basic_salary }}</td>
                            <td class="text-center py-2 px-4">
                                <!-- Delete button to subtract the amount from the total salary -->
                                <form action="{{ route('delete_payslip', ['id' => $payslip->id]) }}" method="POST" class="inline-block" onsubmit="return confirm('Are you sure you want to delete this payslip?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                    @else
                    <tr>
                        <td class="text-center py-2 px-4" colspan="5">No Payslips available for this employee.</td>
                    </tr>
                    @endif
                </tbody>
            </table>
        </div>

        <!-- Allowance Option -->
        <div class="w-full md:w-1/2 px-3 mb-6">
            <h3 class="text-xl font-bold mb-3">Allowances</h3>
            <button class="btn btn-primary mb-3" onclick="toggleModal('allowanceModal')">
                <i class="fas fa-plus"></i>
            </button>
            <table class="min-w-full bg-white border border-gray-300">
                <thead>
                    <tr>
                        <th class="py-2 px-4">Allowance Option</th>
                        <th class="py-2 px-4">Title</th>
                        <th class="py-2 px-4">Type</th>
                        <th class="py-2 px-4">Amount</th>
                        <th class="py-2 px-4">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @if ($employee->allowances && count($employee->allowances) > 0)
                        @foreach($employee->allowances as $allowance)
                            <tr>
                                <td class="text-center py-2 px-4">{{ $allowance->allowanceOption->allowance_option }}</td>
                                <td class="text-center py-2 px-4">{{ $allowance->title }}</td>
                                <td class="text-center py-2 px-4">{{ $allowance->type }}</td>
                                <td class="text-center py-2 px-4">{{ $allowance->amount }}</td>
                                <td class="text-center py-2 px-4">
                                    <!-- Delete button to subtract the amount from the total salary -->
                                    <form action="{{ route('delete_allowance', ['id' => $allowance->id]) }}" method="POST" class="inline-block" onsubmit="return confirm('Are you sure you want to delete this allowance?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </form>
                                </td>
                            </tr>

                        @endforeach
                    @else
                        <tr>
                            <td class="text-center py-2 px-4" colspan="5">No allowances available for this employee.</td>
                        </tr>
                    @endif
                </tbody>
            </table>
        </div>

    </div>

    <div class="flex flex-wrap mb-6">
        <!-- Deduction Option -->
        <div class="w-full md:w-1/2 px-3 mb-6">
            <h3 class="text-xl font-bold mb-3">Deductions</h3>
            <button class="btn btn-primary mb-3" onclick="toggleModal('deductionModal')">
                <i class="fas fa-plus"></i>
            </button>
            <table class="min-w-full bg-white border border-gray-300">
                <thead>
                    <tr>
                        <th class="py-2 px-4">Deduction Option</th>
                        <th class="py-2 px-4">Title</th>
                        <th class="py-2 px-4">Type</th>
                        <th class="py-2 px-4">Amount</th>
                        <th class="py-2 px-4">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @if ($employee->deductions && count($employee->deductions) > 0)
                        @foreach($employee->deductions as $deduction)
                            <tr>
                                <td class="text-center py-2 px-4">{{ $deduction->deductionOption->deduction_option }}</td>
                                <td class="text-center py-2 px-4">{{ $deduction->title }}</td>
                                <td class="text-center py-2 px-4">{{ $deduction->type }}</td>
                                <td class="text-center py-2 px-4">{{ $deduction->deduction_amount }}</td>
                                <td class="text-center py-2 px-4">
                                    <!-- Delete button to remove the deduction -->
                                    <form action="{{ route('delete_deduction', ['id' => $deduction->id]) }}" method="POST" class="inline-block" onsubmit="return confirm('Are you sure you want to delete this deduction?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    @else
                        <tr>
                            <td class="text-center py-2 px-4" colspan="5">No deductions available for this employee.</td>
                        </tr>
                    @endif
                </tbody>
            </table>
        </div>

        <!-- Loan Option -->
        <div class="w-full md:w-1/2 px-3 mb-6">
            <h3 class="text-xl font-bold mb-3">Loans</h3>
            <button class="btn btn-primary mb-3" onclick="toggleModal('loanModal')">
                <i class="fas fa-plus"></i>
            </button>
            <table class="min-w-full bg-white border border-gray-300">
                <thead>
                    <tr>
                        <th class="py-2 px-4">Loan Option</th>
                        <th class="py-2 px-4">Title</th>
                        <th class="py-2 px-4">Type</th>
                        <th class="py-2 px-4">Loan Amount</th>
                        <th class="py-2 px-4">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @if ($employee->loans && $employee->loans()->count() > 0)
                        @foreach($employee->loans as $loan)
                            <tr>
                                <td class="text-center py-2 px-4">{{ optional($loan->loanOption)->loan_option }}</td>
                                <td class="text-center py-2 px-4">{{ $loan->title }}</td>
                                <td class="text-center py-2 px-4">{{ $loan->type }}</td>
                                <td class="text-center py-2 px-4">{{ $loan->loan_amount }}</td>
                                <td class="text-center py-2 px-4">
                                    <form action="{{ route('delete_loan', ['id' => $loan->id]) }}" method="POST" class="inline-block" onsubmit="return confirm('Are you sure you want to delete this loan?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    @else
                        <tr>
                            <td class="text-center py-2 px-4" colspan="5">No loans available for this employee.</td>
                        </tr>
                    @endif
                </tbody>
            </table>
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
                            <form id="payslipForm" action="{{ route('salary.createPayslip', ['employeeId' => $employee->id]) }}" method="POST">
                                @csrf
                                <div class="flex flex-col space-y-2">
                                    <label for="employee_id">Employee ID:</label>
                                    <input type="text" id="employee_id" name="employee_id" value="{{ $employee->id }}" class="border rounded p-2">

                                    <label for="payslip_type">Payroll Type:</label>
                                    <select id="payslip_type" name="payslip_type" class="border rounded p-2" required>
                                        <option value="" disabled selected>Select Payroll Type</option>
                                        @foreach($payslipTypes as $payslipType)
                                            <option value="{{ $payslipType->id }}">{{ $payslipType->payslip_type }}</option>
                                        @endforeach
                                    </select>

                                    <label for="payslip_type_id">Payroll Type ID:</label>
                                    <input type="text" id="payslip_type_id" name="payslip_type_id" class="border rounded p-2" readonly>

                                    <label for="basic_salary">Basic Salary:</label>
                                    <input type="text" id="salary" name="basic_salary" class="border rounded p-2" required>
                                </div>

                                <button type="submit" class="btn btn-primary mt-4">Create Payslip</button>
                            </form>

                            <script>
                                document.getElementById('payslip_type').addEventListener('change', function() {
                                    var payslipTypeId = this.value;  // Get the selected payslip type ID
                                    document.getElementById('payslip_type_id').value = payslipTypeId;  // Update the payslip type ID input
                                });
                            </script>

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
                            <form id="allowanceForm" action="{{ route('salary.createAllowance', ['employeeId' => $employee->id]) }}" method="POST">
                                @csrf
                                <div class="flex flex-col space-y-2">
                                    <input type="hidden" name="employee_id" value="{{ $employee->id }}">

                                    <label for="allowance_option">Allowance Option:</label>
                                    <select id="allowance_option" name="allowance_option_id" class="border rounded p-2" required>
                                        <option value="" disabled selected>Select Allowance Option</option>
                                        @foreach($allowanceOptions as $option)
                                            <option value="{{ $option->id }}">{{ $option->allowance_option}}</option>
                                        @endforeach
                                    </select>

                                    <label for="title">Title:</label>
                                    <input type="text" id="title" name="title" class="border rounded p-2" required>

                                    <label for="type">Type:</label>
                                    <input type="text" id="type" name="type" class="border rounded p-2" required>

                                    <label for="amount">Amount:</label>
                                    <input type="number" step="0.01" id="amount" name="amount" class="border rounded p-2" required>

                                    <!-- Input to store the selected allowance option ID -->
                                    <input type="hidden" id="selected_allowance_option_id" name="allowance_option_id">

                                    <script>
                                        // JavaScript to update the hidden input when an option is selected
                                        const allowanceOptionSelect = document.getElementById('allowance_option');
                                        const selectedAllowanceOptionIdInput = document.getElementById('selected_allowance_option_id');

                                        allowanceOptionSelect.addEventListener('change', () => {
                                            selectedAllowanceOptionIdInput.value = allowanceOptionSelect.value;
                                        });
                                    </script>
                                </div>

                                <button type="submit" class="btn btn-primary mt-4">Create Allowance</button>
                            </form>
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
                            <form id="deductionForm" action="{{ route('salary.createDeduction', ['employeeId' => $employee->id]) }}" method="POST">
                                @csrf
                                <div class="flex flex-col space-y-2">
                                    <label for="deduction_option">Deduction Option:</label>
                                    <select id="deduction_option" name="deduction_option_id" class="border rounded p-2" required>
                                        <option value="" disabled selected>Select Deduction Option</option>
                                        @foreach($deductionOptions as $option)
                                            <option value="{{ $option->id }}">{{ $option->deduction_option }}</option>
                                        @endforeach
                                    </select>

                                    <label for="title">Title:</label>
                                    <input type="text" id="title" name="title" class="border rounded p-2" required>

                                    <label for="type">Type:</label>
                                    <input type="text" id="type" name="type" class="border rounded p-2" required>

                                    <label for="deduction_amount">Amount:</label>
                                    <input type="number" step="0.01" id="deduction_amount" name="deduction_amount" class="border rounded p-2" required>
                                </div>

                                <button type="submit" class="btn btn-primary mt-4">Create Deduction</button>
                            </form>

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
                        </div>
                    </div>
                </div>


                <!--Loan Modal -->
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
                            <form id="loanForm" action="{{ route('salary.createLoan', ['employeeId' => $employee->id]) }}" method="POST">
                                @csrf
                                <div class="flex flex-col space-y-2">
                                    <label for="loan_option_id">Loan Option:</label>
                                    <select id="loan_option_id" name="loan_option_id" class="border rounded p-2" required>
                                        <option value="" disabled selected>Select Loan Option</option>
                                        @foreach($loanOptions as $loanOption)
                                            <option value="{{ $loanOption->id }}">{{ $loanOption->loan_option }}</option>
                                        @endforeach
                                    </select>

                                    <label for="title">Title:</label>
                                    <input type="text" id="title" name="title" class="border rounded p-2" required>

                                    <label for="type">Type:</label>
                                    <input type="text" id="type" name="type" class="border rounded p-2" required>

                                    <label for="loan_amount">Loan Amount:</label>
                                    <input type="number" step="0.01" id="loan_amount" name="loan_amount" class="border rounded p-2" required>
                                </div>

                                <button type="submit" class="btn btn-primary mt-4">Create Loan</button>
                            </form>

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
                        </div>
                    </div>
                </div>

                <form action="{{ route('salary.setSalary', ['employeeId' => $employee->id]) }}" method="POST">
                    @csrf
                    <button type="submit" class="btn btn-success">
                        <i class="fas fa-calculator mr-2"></i>Save Salary
                    </button>
                </form>
        <script>
            document.getElementById('loan_option_id').addEventListener('change', function() {
                var loanOptionId = this.value;  // Get the selected loan option ID
                // Implement logic to automatically update other fields if needed based on the selected loan option
            });
        </script>


<script>
function toggleModal(modalId) {
        const modal = document.getElementById(modalId);
        modal.classList.toggle('hidden');
    }



    // Add event listener to open the modal when the button is clicked
    const openButtons = document.querySelectorAll('.btn-primary');
    openButtons.forEach((button) => {
        button.addEventListener('click', (e) => {
            const modalId = e.target.getAttribute('data-modal');
            toggleModal(modalId);
        });
    });

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
