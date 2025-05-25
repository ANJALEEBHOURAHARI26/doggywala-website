<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Project Sales Report</title>
    <style>
        body {
            font-family: 'DejaVu Sans', sans-serif;
            font-size: 12px;
            color: #333;
        }
        .logo {
            text-align: center;
            margin-bottom: 10px;
        }
        .logo img {
            height: 80px;
        }
        h2 {
            text-align: center;
            margin-bottom: 20px;
            color: #2E5CDA;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 10px;
        }
        th, td {
            border: 1px solid #ccc;
            padding: 8px 10px;
            text-align: left;
        }
        th {
            background-color: #3136C1;
            color: white;
        }
        tr:nth-child(even) {
            background-color: #f5f5f5;
        }
    </style>
</head>
<body>

<div class="logo">
   <img src="{{ public_path('assets/img/applogo.png') }}" alt="Logo" style="height:120px;width: 350px;margin-top: 27px;">
</div>

<h2>Project Sales Report</h2>

<table>
        <tr>
            <td class="label">Date</td>
            <td>{{ \Carbon\Carbon::parse($project->case_start_date)->format('M d, Y') ?? 'N/A'}}</td>
        </tr>
        <tr>
            <td class="label">Invoice No.</td>
            <td>INVC-00{{ $project->invoicePayment->id ?? 'N/A' }}</td>
        </tr>
        <tr>
            <td class="label">Case ID/Job Number</td>
            <td>{{ $project->case_id }}</td>
        </tr>
        <tr>
            <td class="label">Customer Name</td>
            <td>{{ $project->customer->name }}</td>
        </tr>
        <tr>
            <td class="label">Project Name</td>
            <td>{{ $project->case_name }}</td>
        </tr>
        <tr>
            <td class="label">Amount</td>
            <td>${{ number_format($project->invoicePayment->final_amount ?? 0, 2) }}</td>
        </tr>
    </table>

</body>
</html>

