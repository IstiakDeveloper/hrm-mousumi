@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Create Attendance</div>

                <div class="card-body">
                    @if (session('error'))
                        <div class="alert alert-danger">
                            {{ session('error') }}
                        </div>
                    @endif

                    <form action="{{ route('attendances.store') }}" method="POST">
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

                        <div class="form-group">
                            <label for="status">Status</label>
                            <select id="status" name="status" class="form-control" required>
                                <option value="">Select Status</option>
                                <option value="Present">Present</option>
                                <option value="Absent">Absent</option>
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="clock_in">Clock In</label>
                            <input type="time" class="form-control" id="clock_in" name="clock_in">
                            <button type="button" class="btn btn-primary" onclick="handleClockIn()">Clock In</button>
                        </div>

                        <div class="form-group">
                            <label for="clock_out">Clock Out</label>
                            <input type="time" class="form-control" id="clock_out" name="clock_out" step="1">
                            <button type="button" class="btn btn-primary" onclick="handleClockOut()">Clock Out</button>
                        </div>

                        <div class="form-group">
                            <label for="late_minutes">Late Minutes</label>
                            <input type="text" class="form-control" id="late_minutes" name="late_minutes" readonly>
                        </div>

                        <div class="form-group">
                            <label for="early_leaving_minutes">Early Leaving Minutes</label>
                            <input type="text" class="form-control" id="early_leaving_minutes" name="early_leaving_minutes" readonly>
                        </div>

                        <div class="form-group">
                            <label for="overtime_minutes">Overtime Minutes</label>
                            <input type="text" class="form-control" id="overtime_minutes" name="overtime_minutes" readonly>
                        </div>


                        <button type="submit" class="btn btn-primary">Submit</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    let timesheet = {!! $timesheet !!};

    function handleAbsent() {
        document.getElementById('status').value = 'Absent';
        document.getElementById('clock_in').value = "";
        document.getElementById('clock_out').value = "";
        document.getElementById('clock_in').disabled = true;
        document.getElementById('clock_out').disabled = true;
        calculateLate(0);
        calculateEarlyLeaving(0);
        calculateOvertime(0);
    }

    function handleClockIn() {
        document.getElementById('status').value = 'Present';
        document.getElementById('clock_in').value = getCurrentTime();
        document.getElementById('clock_out').disabled = false;
        calculateLate(getCurrentTime());
    }

    function handleClockOut() {
        document.getElementById('clock_out').value = getCurrentTime();
        calculateEarlyLeaving(getCurrentTime());
        calculateOvertime(getCurrentTime());
    }

    function getCurrentTime() {
        const now = new Date();
        const hours = now.getHours().toString().padStart(2, '0');
        const minutes = now.getMinutes().toString().padStart(2, '0');
        return `${hours}:${minutes}`;
    }

    function calculateLate(clockInTime) {
        if (!timesheet || !timesheet.office_start) return;

        const officeStartTime = timesheet.office_start;
        const clockInMinutes = convertToMinutes(clockInTime);
        const officeStartMinutes = convertToMinutes(officeStartTime);
        const lateMinutes = Math.max(0, clockInMinutes - officeStartMinutes);
        document.getElementById('late_minutes').value = lateMinutes;
    }

    function calculateEarlyLeaving(clockOutTime) {
        if (!timesheet || !timesheet.office_end) return;

        const officeEndTime = timesheet.office_end;
        const clockOutMinutes = convertToMinutes(clockOutTime);
        const officeEndMinutes = convertToMinutes(officeEndTime);
        const earlyLeavingMinutes = Math.max(0, officeEndMinutes - clockOutMinutes);
        document.getElementById('early_leaving_minutes').value = earlyLeavingMinutes;
    }

    function calculateOvertime(clockOutTime) {
        if (!timesheet || !timesheet.office_end) return;

        const officeEndTime = timesheet.office_end;
        const clockOutMinutes = convertToMinutes(clockOutTime);
        const officeEndMinutes = convertToMinutes(officeEndTime);
        const overtimeMinutes = Math.max(0, clockOutMinutes - officeEndMinutes);
        document.getElementById('overtime_minutes').value = overtimeMinutes;
    }

    function convertToMinutes(time) {
        const [hours, minutes] = time.split(':').map(Number);
        return hours * 60 + minutes;
    }
</script>

@endsection
