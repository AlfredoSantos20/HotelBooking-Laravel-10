<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Password Change Notification</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 20px;
        }
        .container {
            max-width: 600px;
            margin: 0 auto;
            background-color: #ffffff;
            padding: 20px;
            border-radius: 5px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
        }
        h2 {
            color: #333333;
        }
        p {
            color: #555555;
            line-height: 1.6;
        }
        a {
            color: #1a73e8;
            text-decoration: none;
        }
        a:hover {
            text-decoration: underline;
        }
        .password {
            font-size: 1.5em; /* Increase font size */
            font-weight: bold; /* Optional: make it bold */
            color: #333333; /* Optional: change color for emphasis */
            background-color: #f9f9f9; /* Optional: add background color */
            padding: 5px; /* Optional: add some padding */
            border-radius: 3px; /* Optional: rounded corners */
        }
        .footer {
            margin-top: 20px;
            font-size: 0.9em;
            color: #888888;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>Dear {{ $fname }} {{ $lname }},</h2>
        <p>You requested to change your Password. Check your new password below:</p>
        <p><strong>Email:</strong> {{ $email }}</p>
        <p><strong>Password:</strong> <span class="password">{{ $password }}</span></p> <!-- Updated here -->
        <p>For any queries, you can contact us at: <a href="mailto:hoteldeluna@gmail.com">hoteldeluna@gmail.com</a>.</p>
        <p>Thanks & Regards,<br>Hotel De Luna Team</p>
    </div>
</body>
</html>
