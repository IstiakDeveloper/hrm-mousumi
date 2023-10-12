<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Payslip</title>
    <style>
        /* Add your CSS styling for the PDF here */
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
        }
        .header {
            text-align: center;
            margin-bottom: 20px;
        }
        .logo {
            width: 100px; /* Adjust as needed */
            height: auto;
            margin-bottom: 10px;
        }
        .employee-details {
            margin-bottom: 20px;
        }
        .table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }
        .table th, .table td {
            border: 1px solid #ccc;
            padding: 10px;
            text-align: left;
        }
        .footer {
            text-align: right;
        }
        .signature {
            margin-top: 50px;
        }
    </style>
</head>
<body>
    <div class="header">
        <img src="path_to_your_logo.png" alt="Logo" class="logo">
        <h1>Payslip for {{ $employee->name }}</h1>
        <p>Month: {{ $payslipAnother->month }}</p>
    </div>

    <div class="employee-details">
        <p><strong>Employee ID:</strong> {{ $employee->employee_id }}</p>
        <p><strong>Name:</strong> {{ $employee->name }}</p>
        <!-- Add other employee details as needed -->
    </div>

    <table class="table">
        <thead>
            <tr>
                <th>Description</th>
                <th>Amount</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>Basic Salary</td>
                <td>{{ $payslip->basic_salary }}</td>
            </tr>
            <tr>
                <td>Allowance</td>
                <td>{{ $allowance ? $allowanceTotal : 'N/A' }}</td>
            </tr>
            <tr>
                <td>Loan</td>
                <td>{{ $loan ? '-' . ' '. $loanTotal : 'N/A' }}</td>
            </tr>
            <tr>
                <td>Deduction</td>
                <td>{{ $deduction ? '-' . ' ' . $deductionTotal : 'N/A' }}</td>
            </tr>
            <tr>
                <td><strong>Net Salary</strong></td>
                <td><strong>{{ $salary->net_salary }}</strong></td>
            </tr>
        </tbody>
    </table>

    <div class="footer">
        <p><strong>Status:</strong> {{ $payslipAnother->paid ? 'Paid' : 'Unpaid' }}</p>
    </div>

    <div class="signature">
        <p>Authorized Signature:</p>
        <!-- Add signature image or text as needed -->
    </div>
</body>
</html>
