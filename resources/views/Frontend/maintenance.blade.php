<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>We are under maintenance</title>
    <style>
        body, html {
            height: 100%;
            margin: 0;
            font-family: Arial, sans-serif;
            display: flex;
            align-items: center;
            justify-content: center;
            background-color: #f4f4f9;
            color: #333;
        }

        .container {
            text-align: center;
            padding: 20px;
            background-color: white;
            box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.1);
            border-radius: 10px;
            max-width: 600px;
            width: 100%;
        }

        h1 {
            font-size: 36px;
            color: #2c3e50;
        }

        p {
            font-size: 18px;
            color: #7f8c8d;
        }

        .logo {
            max-width: 150px;
            margin-bottom: 20px;
        }

        .progress {
            width: 100%;
            background-color: #e0e0e0;
            height: 10px;
            border-radius: 5px;
            margin-top: 20px;
        }

        .progress-bar {
            width: 50%;
            height: 100%;
            background-color: #3498db;
            border-radius: 5px;
            animation: loading 2s infinite;
        }

        @keyframes loading {
            0% { width: 0; }
            50% { width: 50%; }
            100% { width: 100%; }
        }
    </style>
</head>
<body>

<div class="container">

    <img class="logo" src="{{ url('Backend/img/mylogo.png') }}" alt="Logo">
    <h1>We’re currently under maintenance</h1>
    <p>Please check back soon. We're working hard to improve your experience!</p>


    <div class="progress">
        <div class="progress-bar"></div>
    </div>
</div>

</body>
</html>
