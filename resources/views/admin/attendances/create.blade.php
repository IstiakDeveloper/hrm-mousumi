@extends('layouts.app')

@section('content')
    <div class="container mx-auto p-4">
        <h1 class="text-2xl mb-4">Attendance Tracking</h1>

        <form action="#" method="POST" class="max-w-md">
            @csrf

            <!-- Clock In -->
            <div id="clockInButton" class="mb-4">
                <button type="button" onclick="clockIn()" class="bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded">Clock In</button>
            </div>

            <!-- Clock Out -->
            <div id="clockOutButton" class="hidden mb-4">
                <button type="button" onclick="clockOut()" class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded">Clock Out</button>
            </div>

            <!-- Display the Clock and Status -->
            <div id="clockStatus" class="mb-4"></div>
        </form>
    </div>

    <script>
        function clockIn() {
            document.getElementById('clockInButton').style.display = 'none';
            document.getElementById('clockOutButton').style.display = 'block';
            document.getElementById('clockStatus').innerText = 'Clocked In at ' + new Date().toLocaleTimeString();
        }

        function clockOut() {
            const clockInTime = new Date();
            const clockOutTime = new Date();
            // Assume some time difference for demonstration purposes
            clockOutTime.setHours(clockInTime.getHours() + 4);

            const lateMinutes = 0; // Assuming no lateness
            const earlyLeaveMinutes = 0; // Assuming no early leave

            const totalTimeWorked = (clockOutTime - clockInTime) / (1000 * 60); // in minutes

            const status = 'Present';

            // Display the details
            const details = `
                Date: ${clockInTime.toDateString()}
                Status: ${status}
                Clock In: ${clockInTime.toLocaleTimeString()}
                Clock Out: ${clockOutTime.toLocaleTimeString()}
                Late Minutes: ${lateMinutes}
                Early Leave Minutes: ${earlyLeaveMinutes}
                Total Worked Minutes: ${totalTimeWorked}
            `;

            document.getElementById('clockStatus').innerText = details;

            // TODO: Send this data to your backend to store in the database
        }
    </script>
@endsection
