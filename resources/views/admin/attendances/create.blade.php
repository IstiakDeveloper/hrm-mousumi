@extends('layouts.app')

@section('content')
<div class="container mx-auto">
    <div class="max-w-md mx-auto my-10 bg-white p-5 rounded shadow-lg">
        <div class="text-center mb-4">
            <h2 class="text-lg font-bold">Create Attendance</h2>
        </div>

        @if (session('error'))
            <div class="alert alert-danger">
                {{ session('error') }}
            </div>
        @endif

        <form action="{{ route('attendances.store') }}" method="POST" id="attendanceForm">
            @csrf
            @if ($errors->any())
                <div class="mb-4 p-2 border border-red-400 bg-red-100 text-red-700">
                    <ul class="list-disc pl-5">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            <input type="hidden" name="employee_id" value="{{ $employeeId }}">
            <input type="hidden" name="date" value="{{ now()->toDateString() }}">

            <div class="mb-4">
                <label for="status" class="block mb-2 font-bold">Status</label>
                <select id="status" name="status" class="w-full py-2 px-3 border border-gray-300 rounded" onchange="handleStatusChange()">
                    <option value="">Select Status</option>
                    <option value="Present">Present</option>
                    <option value="Absent">Absent</option>
                </select>
            </div>

            <div id="clock_section" class="hidden">
                <div class="mb-4">
                    <label for="clock_in" class="block mb-2 font-bold">Clock In (H:i:s)</label>
                    <div class="flex">
                        <input type="text" class="w-full py-2 px-3 border border-gray-300 rounded" id="clock_in" name="clock_in" placeholder="HH:MM:SS">
                        <button type="button" class="ml-2 py-2 px-4 bg-blue-500 text-white rounded" onclick="handleClockIn()" id="clockInButton">
                            <i class="fas fa-clock"></i> Clock In
                        </button>
                    </div>
                </div>

                <div class="mb-4" id="clock_out_section" style="display: none;">
                    <label for="clock_out" class="block mb-2 font-bold">Clock Out (H:i:s)</label>
                    <div class="flex">
                        <input type="text" class="w-full py-2 px-3 border border-gray-300 rounded" id="clock_out" name="clock_out" placeholder="HH:MM:SS" readonly>
                        <button type="button" class="ml-2 py-2 px-4 bg-blue-500 text-white rounded" onclick="handleClockOut()" id="clockOutButton">
                            <i class="fas fa-clock"></i> Clock Out
                        </button>
                    </div>
                </div>
            </div>

            <div id="stopwatch" class="hidden">
                <p class="font-bold mb-2">Stopwatch:</p>
                <span id="stopwatch_display">00:00:00</span>
            </div>

            <div id="late_early_overtime_section" class="hidden">
                <div class="mb-4">
                    <label for="late_minutes" class="block mb-2 font-bold">Late Minutes</label>
                    <input type="text" class="w-full py-2 px-3 border border-gray-300 rounded" id="late_minutes" name="late_minutes" readonly>
                </div>

                <div class="mb-4">
                    <label for="early_leaving_minutes" class="block mb-2 font-bold">Early Leaving Minutes</label>
                    <input type="text" class="w-full py-2 px-3 border border-gray-300 rounded" id="early_leaving_minutes" name="early_leaving_minutes" readonly>
                </div>

                <div class="mb-4">
                    <label for="overtime_minutes" class="block mb-2 font-bold">Overtime Minutes</label>
                    <input type="text" class="w-full py-2 px-3 border border-gray-300 rounded" id="overtime_minutes" name="overtime_minutes" readonly>
                </div>
            </div>

            <button type="button" class="py-2 px-4 bg-blue-500 text-white rounded" id="submitButton" disabled>
                <i class="fas fa-check"></i> Submit
            </button>
        </form>
    </div>
</div>

<script>
    let timesheet = {!! $timesheet !!};
    let stopwatchInterval;
    let stopwatchTime = 0;

    function handleClockIn() {
        document.getElementById('status').value = 'Present';
        document.getElementById('clock_in').value = getCurrentTime();
        document.getElementById('clock_out').disabled = false;
        document.getElementById('clockOutButton').disabled = false;
        document.getElementById('stopwatch').classList.remove('hidden');
        startStopwatch();
        document.getElementById('clock_out_section').style.display = 'block';
        document.getElementById('clockInButton').classList.add('hidden');
        document.getElementById('clock_in').classList.add('hidden');
    }

    function handleClockOut() {
        document.getElementById('clock_out').value = getCurrentTime();
        calculateLate(document.getElementById('clock_in').value);
        calculateEarlyLeaving(getCurrentTime());
        calculateOvertime(getCurrentTime());
        clearInterval(stopwatchInterval);
        document.getElementById('submitButton').disabled = false;
        document.getElementById('attendanceForm').submit();
    }

    function getCurrentTime() {
        const now = new Date();
        const hours = now.getHours().toString().padStart(2, '0');
        const minutes = now.getMinutes().toString().padStart(2, '0');
        const seconds = now.getSeconds().toString().padStart(2, '0');
        return `${hours}:${minutes}:${seconds}`;
    }

    function calculateLate(clockInTime) {
        if (!timesheet || !timesheet.office_start) return;

        const officeStartTime = timesheet.office_start;
        const officeStartMinutes = convertToMinutes(officeStartTime);
        const clockInMinutes = convertToMinutes(clockInTime);
        const lateMinutes = Math.max(0, clockInMinutes - officeStartMinutes);
        document.getElementById('late_minutes').value = lateMinutes;
    }

    function calculateEarlyLeaving(clockOutTime) {
        if (!timesheet || !timesheet.office_end) return;

        const officeEndTime = timesheet.office_end;
        const officeEndMinutes = convertToMinutes(officeEndTime);
        const clockOutMinutes = convertToMinutes(clockOutTime);
        const earlyLeavingMinutes = Math.max(0, officeEndMinutes - clockOutMinutes);
        document.getElementById('early_leaving_minutes').value = earlyLeavingMinutes;
    }

    function calculateOvertime(clockOutTime) {
        if (!timesheet || !timesheet.office_end) return;

        const officeEndTime = timesheet.office_end;
        const officeEndMinutes = convertToMinutes(officeEndTime);
        const clockOutMinutes = convertToMinutes(clockOutTime);

        const overtimeMinutes = Math.max(0, clockOutMinutes - officeEndMinutes);
        document.getElementById('overtime_minutes').value = overtimeMinutes;
    }

    function convertToMinutes(time) {
        const [hours, minutes, seconds] = time.split(':').map(Number);
        return hours * 60 + minutes + seconds / 60;
    }

    function startStopwatch() {
        stopwatchTime = 0;
        const stopwatchDisplay = document.getElementById('stopwatch_display');
        stopwatchInterval = setInterval(() => {
            stopwatchTime++;
            const formattedTime = formatStopwatchTime(stopwatchTime);
            stopwatchDisplay.innerText = formattedTime;
        }, 1000);
    }

    function formatStopwatchTime(timeInSeconds) {
        const hours = Math.floor(timeInSeconds / 3600).toString().padStart(2, '0');
        const minutes = Math.floor((timeInSeconds % 3600) / 60).toString().padStart(2, '0');
        const seconds = (timeInSeconds % 60).toString().padStart(2, '0');
        return `${hours}:${minutes}:${seconds}`;
    }

    function handleStatusChange() {
        const status = document.getElementById('status').value;
        const clockSection = document.getElementById('clock_section');
        const lateEarlyOvertimeSection = document.getElementById('late_early_overtime_section');
        const clockOutSection = document.getElementById('clock_out_section');

        if (status === 'Absent') {
            clockSection.style.display = 'none';  // Hide clock_section
            lateEarlyOvertimeSection.style.display = 'none';  // Hide late_early_overtime_section
            clockOutSection.style.display = 'none';  // Hide clock_out_section
            document.getElementById('stopwatch').classList.add('hidden');
            clearInterval(stopwatchInterval);
            document.getElementById('submitButton').disabled = false;
        } else {
            clockSection.style.display = 'block';  // Show clock_section
            lateEarlyOvertimeSection.style.display = 'block';  // Show late_early_overtime_section
            clockOutSection.style.display = 'block';  // Show clock_out_section
            document.getElementById('clockInButton').disabled = false;
        }
    }
</script>


@endsection
