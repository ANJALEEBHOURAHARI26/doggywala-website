<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>New Booking Received</title>
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: #f3f6fa;
            margin: 0;
            padding: 0;
        }

        .email-container {
            max-width: 620px;
            margin: 40px auto;
            background: #ffffff;
            padding: 40px 30px;
            border-radius: 12px;
            box-shadow: 0 8px 16px rgba(0, 0, 0, 0.08);
        }

        .email-header {
            text-align: center;
            border-bottom: 2px solid #eeeeee;
            padding-bottom: 20px;
            margin-bottom: 30px;
        }

        .email-header h2 {
            color: #1f2e4d;
            font-size: 26px;
            margin: 0;
        }

        .email-content p {
            font-size: 16px;
            color: #333;
            margin: 12px 0;
        }

        .email-content .label {
            font-weight: bold;
            color: #1f2e4d;
        }

        .footer {
            text-align: center;
            margin-top: 40px;
            font-size: 14px;
            color: #888;
        }

        .highlight {
            background-color: #f0f4f8;
            padding: 8px 12px;
            border-radius: 5px;
            display: inline-block;
            margin-left: 5px;
            color: #34495e;
        }
    </style>
</head>
<body>
    <div class="email-container">
        <div class="email-header">
            <h2>New Grooming Appointment Booking</h2>
        </div>

        <div class="email-content">
            <p><span class="label">Name:</span> <span class="highlight">{{ $booking->name }}</span></p>
            <p><span class="label">Phone:</span> <span class="highlight">{{ $booking->phone }}</span></p>
            <p><span class="label">Service:</span> <span class="highlight">{{ $booking->service }}</span></p>
            <p><span class="label">Date:</span> <span class="highlight">{{ $booking->appointment_date }}</span></p>
            <p><span class="label">Time:</span> <span class="highlight">{{ $booking->appointment_time }}</span></p>

            @if($booking->message)
            <p><span class="label">Message:</span> <span class="highlight">{{ $booking->message }}</span></p>
            @endif
        </div>

        <div class="footer">
            This is an automated message from Doggywala. Please do not reply.
        </div>
    </div>
</body>
</html>
