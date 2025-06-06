<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>New Enquiry Received</title>
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
        }

        .email-container {
            max-width: 600px;
            background-color: #ffffff;
            margin: 30px auto;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        h2 {
            color: #2c3e50;
            margin-bottom: 20px;
            font-size: 24px;
        }

        p {
            margin: 10px 0;
            color: #333333;
            font-size: 16px;
        }

        .label {
            font-weight: bold;
            color: #555555;
        }

        .footer {
            margin-top: 30px;
            font-size: 14px;
            color: #888888;
            text-align: center;
        }
    </style>
</head>
<body>
    <div class="email-container">
        <h2>🐶 New Puppy Enquiry Received</h2>

        <p><span class="label">Name:</span> {{ $data['name'] }}</p>
        <p><span class="label">Email:</span> {{ $data['email'] }}</p>
        <p><span class="label">Phone Number:</span> {{ $data['phone'] }}</p>
        <p><span class="label">City:</span> {{ $data['cityname'] }}</p>
        <p><span class="label">Breed:</span> {{ $data['breedname'] }}</p>
        <p><span class="label">Price Range:</span> {{ $data['price_range'] }}</p>
        <p><span class="label">Message:</span><br>{{ $data['message'] }}</p>
        <!-- <p><span class="label">Source Page:</span> {{ $data['functionname'] ?? 'N/A' }}</p> -->

        <div class="footer">
            This enquiry was submitted through the Doggywala website.
        </div>
    </div>
</body>
</html>
