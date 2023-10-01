<!-- view/admin/dashboard.blade.php -->
@extends('layouts.app')

@section('content')
<!-- Content -->
<main class="flex-1 p-10">
    <!-- Dashboard header -->
    <div class="flex justify-between items-center mb-6">
        <h2 class="text-3xl font-bold text-gray-900">Dashboard</h2>
        <!-- Add any additional header content here -->
    </div>

    <!-- Timesheet data section -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
        <!-- Total Hours Worked -->
        <div class="bg-white p-6 rounded-lg shadow-lg">
            <h3 class="text-xl font-bold mb-2">Total Hours Worked</h3>
            <p class="text-3xl font-bold text-blue-500">160 hours</p>
        </div>

        <!-- Leave Requests -->
        <div class="bg-white p-6 rounded-lg shadow-lg">
            <h3 class="text-xl font-bold mb-2">Leave Requests</h3>
            <p class="text-3xl font-bold text-green-500">5 requests</p>
        </div>

        <!-- Performance Metrics -->
        <div class="bg-white p-6 rounded-lg shadow-lg">
            <h3 class="text-xl font-bold mb-2">Performance Metrics</h3>
            <!-- Display performance metrics here -->
            <ul>
                <li class="flex justify-between items-center">
                    <span>Productivity</span>
                    <span class="font-bold text-green-500">80%</span>
                </li>
                <li class="flex justify-between items-center">
                    <span>Attendance</span>
                    <span class="font-bold text-green-500">95%</span>
                </li>
                <!-- Add more metrics as needed -->
            </ul>
        </div>

        <!-- Recent Activities -->
        <div class="bg-white p-6 col-span-3 rounded-lg shadow-lg">
            <h3 class="text-xl font-bold mb-2">Recent Activities</h3>
            <!-- Display recent activities here -->
            <ul>
                <li>John Doe submitted a timesheet.</li>
                <li>Mary Smith requested a leave.</li>
                <!-- Add more recent activities as needed -->
            </ul>
        </div>

        <!-- Employee List -->
        <div class="bg-white p-6 rounded-lg shadow-lg">
            <h3 class="text-xl font-bold mb-2">Employee List</h3>
            <!-- Display employee list here -->
            <ul>
                <li>John Doe</li>
                <li>Mary Smith</li>
                <!-- Add more employees as needed -->
            </ul>
        </div>

        <!-- Employee Statistics -->
        <div class="bg-white p-6 rounded-lg shadow-lg">
            <h3 class="text-xl font-bold mb-2">Employee Statistics</h3>
            <!-- Display employee statistics here -->
            <ul>
                <li class="flex justify-between items-center">
                    <span>Male</span>
                    <span class="font-bold text-blue-500">60%</span>
                </li>
                <li class="flex justify-between items-center">
                    <span>Female</span>
                    <span class="font-bold text-pink-500">40%</span>
                </li>
                <!-- Add more statistics as needed -->
            </ul>
        </div>

        <!-- Line Chart -->
        <div class="bg-white p-6 rounded-lg shadow-lg">
            <h3 class="text-xl font-bold mb-4">Productivity Trend</h3>
            <canvas id="lineChart" width="400" height="200"></canvas>
        </div>

        <!-- Bar Chart -->
        <div class="bg-white p-6 rounded-lg shadow-lg">
            <h3 class="text-xl font-bold mb-4">Leave Types Breakdown</h3>
            <canvas id="barChart" width="400" height="200"></canvas>
        </div>

        <!-- Pie Chart -->
        <div class="bg-white p-6 rounded-lg shadow-lg">
            <h3 class="text-xl font-bold mb-4">Employee Gender Distribution</h3>
            <canvas id="pieChart" width="400" height="200"></canvas>
        </div>
    </div>

    <!-- Additional Widgets or Charts -->
    <!-- Add more widgets or charts to display HRM data as needed -->
    <!-- Example:
    <div class="bg-white p-6 rounded-lg shadow-lg col-span-3">
        <h3 class="text-xl font-bold mb-2">Additional Widget</h3>
        <p class="text-3xl font-bold">Widget Content</p>
    </div>
    -->
</main>

<!-- Include Chart.js for chart rendering -->
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<!-- JavaScript for creating and updating charts -->
<script>
    // Line Chart
    var lineChart = new Chart(document.getElementById('lineChart').getContext('2d'), {
        type: 'line',
        data: {
            labels: ['January', 'February', 'March', 'April', 'May', 'June'],
            datasets: [{
                label: 'Productivity',
                data: [65, 59, 80, 81, 56, 55],
                borderColor: 'rgba(54, 162, 235, 1)',
                borderWidth: 2,
                backgroundColor: 'rgba(54, 162, 235, 0.2)',
            }]
        },
        options: {
            scales: {
                y: {
                    beginAtZero: true,
                    suggestedMax: 100,
                }
            }
        }
    });

    // Bar Chart
    var barChart = new Chart(document.getElementById('barChart').getContext('2d'), {
        type: 'bar',
        data: {
            labels: ['Vacation', 'Sick Leave', 'Maternity', 'Paternity'],
            datasets: [{
                label: 'Number of Requests',
                data: [12, 19, 3, 5],
                backgroundColor: 'rgba(54, 162, 235, 0.5)',
                borderColor: 'rgba(54, 162, 235, 1)',
                borderWidth: 1
            }]
        },
        options: {
            scales: {
                y: {
                    beginAtZero: true,
                    suggestedMax: 20,
                }
            }
        }
    });

    // Pie Chart
    var pieChart = new Chart(document.getElementById('pieChart').getContext('2d'), {
        type: 'pie',
        data: {
            labels: ['Male', 'Female'],
            datasets: [{
                data: [60, 40],
                backgroundColor: [
                    'rgba(54, 162, 235, 0.5)',
                    'rgba(255, 99, 132, 0.5)'
                ],
                borderColor: [
                    'rgba(54, 162, 235, 1)',
                    'rgba(255, 99, 132, 1)'
                ],
                borderWidth: 1
            }]
        }
    });
</script>
``

@endsection
