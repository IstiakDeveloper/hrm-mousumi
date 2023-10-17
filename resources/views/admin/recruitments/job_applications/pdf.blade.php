<!DOCTYPE html>
<html>
<head>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Roboto:wght@400;700&display=swap');

        body {
            font-family: 'Roboto', Arial, sans-serif;
        }
        .container {
            max-width: 800px;
            margin: 0 auto;
            padding: 20px;
            border: 2px solid #333;
            border-radius: 10px;
            background-color: #f9f9f9;
        }
        h1 {
            font-size: 24px;
            font-weight: bold;
            margin-bottom: 10px;
            color: #333;
        }
        p {
            margin-bottom: 10px;
            font-size: 16px;
        }
        strong {
            font-weight: bold;
            margin-right: 5px;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1 class="text-2xl font-bold mb-4">Job Application Details</h1>

        <p><strong>Name:</strong> {{ $jobApplication->name }}</p>
        <p><strong>Email:</strong> {{ $jobApplication->email }}</p>
        <p><strong>Phone:</strong> {{ $jobApplication->phone }}</p>
        <p><strong>Cover Letter:</strong> {{ $jobApplication->cover_letter }}</p>
        <p><strong>Date of Birth:</strong> {{ $jobApplication->date_of_birth }}</p>
        <p><strong>Address:</strong> {{ $jobApplication->address }}</p>

    </div>

</body>
</html>
