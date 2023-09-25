@extends('layouts.app')

@section('content')
    <div class="container mx-auto p-4">
        <h1 class="text-2xl mb-4">Apply for Leave</h1>
        <form action="{{ route('leave.store') }}" method="POST" class="max-w-md">
            @csrf
                        <!-- Display error messages -->
                        @if ($errors->any())
                        <div class="mb-4 p-2 border border-red-400 bg-red-100 text-red-700">
                            <ul class="list-disc pl-5">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

            <!-- Employee ID (Assuming it's a hidden field, adjust as needed) -->
            <input type="hidden" name="employee_id" value="{{ $employeeId }}">

            <!-- Leave Type -->
            <div class="mb-4">
                <label for="leave_type_id" class="block text-gray-700 text-sm font-bold mb-2">Leave Type:</label>
                <select name="leave_type_id" id="leave_type_id" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                    @foreach ($leaveTypes as $leaveType)
                        <option value="{{ $leaveType->id }}">{{ $leaveType->leave_type }}</option>
                    @endforeach
                </select>
                @error('leave_type_id')
                    <p class="text-red-500 text-xs italic">{{ $message }}</p>
                @enderror
            </div>

            <!-- Applied On -->
            <div class="mb-4">
                <label for="applied_on" class="block text-gray-700 text-sm font-bold mb-2">Applied On:</label>
                <input type="date" name="applied_on" id="applied_on" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                @error('applied_on')
                    <p class="text-red-500 text-xs italic">{{ $message }}</p>
                @enderror
            </div>

            <!-- Start Date -->
            <div class="mb-4">
                <label for="start_date" class="block text-gray-700 text-sm font-bold mb-2">Start Date:</label>
                <input type="date" name="start_date" id="start_date" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                @error('start_date')
                    <p class="text-red-500 text-xs italic">{{ $message }}</p>
                @enderror
            </div>

            <!-- End Date -->
            <div class="mb-4">
                <label for="end_date" class="block text-gray-700 text-sm font-bold mb-2">End Date:</label>
                <input type="date" name="end_date" id="end_date" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                @error('end_date')
                    <p class="text-red-500 text-xs italic">{{ $message }}</p>
                @enderror
            </div>

            <!-- Total Days (Automatically calculated) -->
            <div class="mb-4">
                <label for="total_days" class="block text-gray-700 text-sm font-bold mb-2">Total Days:</label>
                <input type="number" name="total_days" id="total_days" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" readonly>
                @error('total_days')
                    <p class="text-red-500 text-xs italic">{{ $message }}</p>
                @enderror
            </div>

            <!-- Leave Reason -->
            <div class="mb-4">
                <label for="leave_reason" class="block text-gray-700 text-sm font-bold mb-2">Leave Reason:</label>
                <textarea name="leave_reason" id="leave_reason" rows="3" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"></textarea>
                @error('leave_reason')
                    <p class="text-red-500 text-xs italic">{{ $message }}</p>
                @enderror
            </div>

            <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">Submit</button>
        </form>
    </div>

    <script>
        // Function to calculate the difference in days between start_date and end_date
        function calculateTotalDays() {
            const startDate = new Date(document.getElementById('start_date').value);
            const endDate = new Date(document.getElementById('end_date').value);

            if (!isNaN(startDate.getTime()) && !isNaN(endDate.getTime())) {
                const diffTime = Math.abs(endDate - startDate);
                const diffDays = Math.ceil(diffTime / (1000 * 60 * 60 * 24));
                document.getElementById('total_days').value = diffDays;
            }
        }

        // Add event listener to the end_date input
        document.getElementById('end_date').addEventListener('change', calculateTotalDays);
    </script>
@endsection
