<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Employee Profile - PDF</title>
    <!-- Include Tailwind CSS -->
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <style>
        /* Define your custom styles here */
        body {
            font-family: Arial, sans-serif;
            background-color: #f0f0f0;
        }

        .container {
            max-width: 800px;
            margin: 0 auto;
            padding: 20px;
            background-color: #fff;
            box-shadow: 0px 0px 5px rgba(0, 0, 0, 0.2);
            text-align: center; /* Center-align all content */
        }

        .container img {
            max-width: 100%;
            height: auto;
        }

        h1 {
            font-size: 24px;
            font-weight: bold;
            margin-bottom: 20px;
        }

        /* Additional styling for improved design */
        .info-label {
            font-weight: bold;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1 class="text-2xl">{{ $employee->name }}</h1>
        <p class="text-gray-600">Employee ID: {{ $employee->employee_id }}</p>

        <div class="w-32 h-32 mx-auto bg-gray-300 rounded-full mt-4">
            @if ($employee->photo)
                <img src="{{ public_path('storage/' . $employee->photo) }}" alt="Employee Photo">
            @else
                <span class="text-gray-600 text-4xl flex items-center justify-center h-full w-full">No Photo</span>
            @endif
        </div>




        <!-- Personal Information -->
        <div class="mt-4 border-t border-gray-300">
            <h2 class="text-xl font-semibold">Personal Information</h2>
            <dl class="grid grid-cols-2 gap-4">
                <div class="mb-4">
                    <span class="info-label">Phone:</span>
                    <span>{{ $employee->phone }}</span>
                </div>
                <div class="mb-4">
                    <span class="info-label">Date of Birth:</span>
                    <span>{{ $employee->date_of_birth }}</span>
                </div>
                <div class="mb-4">
                    <span class="info-label">Gender:</span>
                    <span>{{ $employee->gender }}</span>
                </div>
                <div class="mb-4">
                    <span class="info-label">Email:</span>
                    <span>{{ $employee->email }}</span>
                </div>
                <div class="mb-4">
                    <span class="info-label">Address:</span>
                    <span>{{ $employee->address }}</span>
                </div>
            </dl>
        </div>

        <!-- Company Information -->
        <div class="mt-4 border-t border-gray-300">
            <h2 class="text-xl font-semibold">Company Information</h2>
            <dl class="grid grid-cols-2 gap-4">
                <div class="mb-4">
                    <span class="info-label">Branch:</span>
                    <span>{{ $employee->branch->name }}</span>
                </div>
                <div class="mb-4">
                    <span class="info-label">Department:</span>
                    <span>{{ $employee->department->name }}</span>
                </div>
                <div class="mb-4">
                    <span class="info-label">Designation:</span>
                    <span>{{ $employee->designation->name }}</span>
                </div>
                <div class="mb-4">
                    <span class="info-label">Date of Joining:</span>
                    <span>{{ $employee->date_of_joining }}</span>
                </div>
            </dl>
        </div>

        <!-- Document Information -->
        <div class="mt-4 border-t border-gray-300">
            <h2 class="text-xl font-semibold">Document Information</h2>
            <dl class="grid grid-cols-2 gap-4">
                <div class="mb-4">
                    <span class="info-label">Certificate:</span>
                    @if ($employee->certificate)
                        <a href="{{ asset('storage/' . $employee->certificate) }}" class="text-blue-500 hover:underline" target="_blank">View Certificate</a>
                    @else
                        <span>No certificate uploaded</span>
                    @endif
                </div>
                <div class="mb-4">
                    <span class="info-label">Resume:</span>
                    @if ($employee->resume)
                        <a href="{{ asset('storage/' . $employee->resume) }}" class="text-blue-500 hover:underline" target="_blank">View Resume</a>
                    @else
                        <span>No resume uploaded</span>
                    @endif
                </div>
            </dl>
        </div>

        <div class="mt-4 border-t border-gray-300">
            <h2 class="text-xl font-semibold">Bank Details</h2>
            <dl class="grid grid-cols-2 gap-4">
                <div class="mb-4">
                    <span class="info-label">Account Holder Name:</span>
                    <span>{{ $employee->account_holder_name ?? 'Not provided' }}</span>
                </div>
                <div class="mb-4">
                    <span class="info-label">Account Number:</span>
                    <span>{{ $employee->account_number ?? 'Not provided' }}</span>
                </div>
                <div class="mb-4">
                    <span class="info-label">Bank Name:</span>
                    <span>{{ $employee->bank_name ?? 'Not provided' }}</span>
                </div>
                <div class="mb-4">
                    <span class="info-label">Branch Location:</span>
                    <span>{{ $employee->branch_location ?? 'Not provided' }}</span>
                </div>
                <div class="mb-4">
                    <span class="info-label">Swift Code:</span>
                    <span>{{ $employee->swift_code ?? 'Not provided' }}</span>
                </div>
            </dl>
        </div>
    </div>
</body>
</html>
