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
   <img src="{{ public_path('assets/img/applogo.png') }}" alt="Logo" style="height:120px;width: 381px;margin-top: 27px;">
</div>

<h2>Expenses Report</h2>

<table>
    <thead>
        <tr>
            <th>Date</th>
            <th>Case ID/Job Number</th>
            <th>Expense Name</th>
            <th>Category</th>
            <th>Created by</th>
            <th>Amount</th>
        </tr>
    </thead>
    <tbody>
        @foreach($expenseDetails as $expenseDetails)
            <tr>
                <td>{{ \Carbon\Carbon::parse($expenseDetails->date)->format('F d Y') }}</td>
                <td>{{ $expenseDetails->case_id }}</td>
                <td>{{ $expenseDetails->expense_name }}</td>
                <td>{{ $expenseDetails->category}}</td>
                <td>{{ $expenseDetails->users->name}}</td>
                <td>{{ $expenseDetails->amount }}</td>
            </tr>
        @endforeach
    </tbody>
</table>

</body>
</html>

