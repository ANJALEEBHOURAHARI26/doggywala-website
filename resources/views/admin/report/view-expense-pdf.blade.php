<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Expenses Report</title>
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

<h2>Expenses Report</h2>

<table>
        <tr>
            <td class="label">Date</td>
            <td>{{ \Carbon\Carbon::parse($expense->date)->format('M d Y') ?? 'N/A'}}</td>
        </tr>
        <tr>
            <td class="label">Case ID/Job Number</td>
            <td>{{ $expense->case_id ?? 'N/A'}}</td>
        </tr>
        <tr>
            <td class="label">Created By</td>
            <td>{{ $expense->users->name ?? 'N/A'}}</td>
        </tr>
        <tr>
            <td class="label">Expense Name</td>
            <td>{{ $expense->expense_name ?? 'N/A' }}</td>
        </tr>
        <tr>
            <td class="label">Category</td>
            <td>{{ $expense->category ?? 'N/A'}}</td>
        </tr>
        <tr>
            <td class="label">Amount</td>
            <td>${{ $expense->amount ?? 'N/A'}}</td>
        </tr>
    </table>

</body>
</html>

