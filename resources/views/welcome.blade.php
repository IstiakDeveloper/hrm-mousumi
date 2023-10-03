<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>HRM Login</title>
    <link rel="stylesheet" href="https://unpkg.com/tailwindcss@^2.0/dist/tailwind.min.css">
    <style>
        /* Additional styles for the login button */
        .login-button {
            background-color: #4CAF50; /* Green */
            color: white;
            padding: 14px 20px;
            text-align: center;
            text-decoration: none;
            display: inline-block;
            font-size: 16px;
            margin: 4px 2px;
            cursor: pointer;
            border-radius: 12px;
            transition: background-color 0.3s;
        }

        .login-button:hover {
            background-color: #45a049;
        }
    </style>
</head>

<body class="flex items-center justify-center h-screen bg-gray-200">
    <div class="text-center">
        <h1 class="text-2xl font-bold mb-4">HRM Login</h1>
        <a href="{{route('login')}}" class="login-button">Login</a>
    </div>
</body>

</html>
