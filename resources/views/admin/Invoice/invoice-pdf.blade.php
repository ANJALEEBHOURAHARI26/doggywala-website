<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Invoice Report</title>
    <style>
        body {
            font-family: 'DejaVu Sans', sans-serif;
            color: #333;
            font-size: 12px;
        }
        .logo {
            text-align: center;
            margin-bottom: 20px;
        }
        .logo img {
            height: 80px;
        }
        h2 {
            text-align: center;
            color: #2E5CDA;
            margin-bottom: 10px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 25px;
        }
        th {
            background-color: #3136C1;
            color: white;
            padding: 8px 12px;
            font-size: 13px;
            text-align: left;
            border: 1px solid #ccc;
        }
        td {
            border: 1px solid #ccc;
            padding: 8px 12px;
            font-size: 12px;
        }
        tr:nth-child(even) {
            background-color: #f2f2f2;
        }
    </style>
</head>
<body>

    <div class="logo">
        <img src="{{ public_path('assets/img/applogo.png') }}" alt="Logo" style="height:120px;width: 381px;margin-top: 27px;">
    </div>

    <h2>Invoice Payment Report</h2>

    <table>
        <thead>
            <tr>
                <th>Date</th>
                <th>Invoice No.</th>
                <th>Case ID/Job Number</th>
                <th>Customer</th>
                <th>Project</th>
                <th>Amount ($)</th>
            </tr>
        </thead>
        <tbody>
            @foreach($invoicePayments as $invoice)
                <tr>
                    <td>{{ \Carbon\Carbon::parse($invoice->date)->format('d M Y') }}</td>
                    <td>INV-00{{ $invoice->id }}</td>
                    <td>{{ $invoice->projects->case_id ?? '-' }}</td>
                    <td>{{ $invoice->projects->employee->full_name ?? '-' }}</td>
                    <td>{{ $invoice->projects->case_name ?? '-' }}</td>
                    <td>{{ number_format($invoice->final_amount, 2) }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>

</body>
</html>
