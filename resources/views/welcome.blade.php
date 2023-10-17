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
        .career-button {
            background-color: blue; /* Green */
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
        .career-button:hover {
            background-color: #1f15af;
        }
    </style>
</head>

<body class="flex items-center justify-center h-screen bg-gray-200">
    <div class="flex justify-between w-full max-w-screen-lg mx-auto">
        <div class="flex flex-col items-center justify-center border-l-2 border-green-600 p-8">
            <h1 class="text-2xl font-bold mb-4">HRM Admin Login</h1>
            <a href="{{route('login')}}" class="login-button">Login</a>
        </div>
        <div class="flex flex-col items-center border-l-2 border-blue-600 justify-center p-8">
            <h1 class="text-2xl font-bold mb-4">Our Job Section</h1>
            <a href="{{route('career.index')}}" class="career-button">Career</a>
        </div>
    </div>
</body>


</html>
