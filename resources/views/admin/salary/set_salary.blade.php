@extends('layouts.app')

@section('content')
    <div class="bg-white p-4 shadow rounded-md">
        <h1 class="text-2xl font-semibold mb-4">Set Salary for {{ $employee->name }}</h1>
        <form method="POST" action="{{ route('employee.setSalary', $employee->id) }}">
            @csrf

            <div class="mb-4">
                <label for="salary_grade_id" class="block text-gray-700 text-sm font-bold mb-2">Select Salary Grade:</label>
                <select name="salary_grade_id" id="salary_grade_id" class="border rounded w-full py-2 px-3" required>
                    <option value="">Select Salary Grade</option>
                    @foreach($salaryGrades as $grade)
                        <option value="{{ $grade->id }}">{{ $grade->grade_name }}</option>
                    @endforeach
                </select>
            </div>

            <div class="mb-4">
                <label for="salary_step_id" class="block text-gray-700 text-sm font-bold mb-2">Select Salary Step:</label>
                <select name="salary_step_id" id="salary_step_id" class="border rounded w-full py-2 px-3" required>
                    <option value="">Select Salary Step</option>
                    @if (isset($selectedGrade))
                        @foreach ($selectedGrade->steps as $step)
                            <option value="{{ $step->id }}">{{ $step->step_name }}</option>
                        @endforeach
                    @endif
                </select>
            </div>

            @if ($loans->count() > 0)
                @foreach ($loans as $loan)
                    <div class="mb-4">
                        <label for="{{ $loan->loan_type }}" class="block text-gray-700 text-sm font-bold mb-2">{{ ucfirst($loan->loan_type) }} Loan:</label>
                        <input type="text" name="{{ $loan->loan_type }}" id="{{ $loan->loan_type }}" class="border rounded w-full py-2 px-3" placeholder="Enter {{ ucfirst($loan->loan_type) }} Loan" value="{{ $loan->monthly_payment ?? '' }}" readonly>
                    </div>
                @endforeach
            @else
                <p>No loan information available for this employee.</p>
            @endif






            <div class="mt-6">
                <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded-full">Set Salary</button>
            </div>
        </form>
    </div>

    <script>
        document.getElementById('salary_grade_id').addEventListener('change', function () {
            console.log('Grade selected'); // For debugging

            var selectedGradeId = this.value;
            var salaryStepSelect = document.getElementById('salary_step_id');

            // Clear existing options
            salaryStepSelect.innerHTML = '';

            if (selectedGradeId !== '') {
                // Make an AJAX request to get the steps for the selected grade
                fetch(`/get-steps-by-grade/${selectedGradeId}`)
                    .then(response => response.json())
                    .then(data => {
                        if (Array.isArray(data.steps)) {
                            data.steps.forEach(step => {
                                var option = document.createElement('option');
                                option.value = step.id;
                                option.textContent = step.step_name;
                                salaryStepSelect.appendChild(option);
                            });
                        } else {
                            console.error('Data is not an array:', data);
                        }
                    })
                    .catch(error => {
                        console.error('Error fetching steps:', error);
                    });
            }
        });
    </script>

@endsection
