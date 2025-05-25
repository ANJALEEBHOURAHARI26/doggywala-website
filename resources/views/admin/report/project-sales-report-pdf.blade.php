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
   <img src="{{ public_path('assets/img/applogo.png') }}" alt="Logo" style="height:120px;width: 381px;margin-top: 27px;">
</div>

<h2>Project Sales Report</h2>

<table>
    <thead>
        <tr>
            <th>Date</th>
            <th>Invoice No.</th>
            <th>Case ID/Job Number</th>
            <th>Customer Name</th>
            <th>Project Name</th>
            <th>Amount ($)</th>
            <th>Discount ($)</th>
            <th>Total ($)</th>
        </tr>
    </thead>
    <tbody>
        @foreach($projects as $project)
             @php $multi_paid_total = \DB::table('invoice_multi_pay')
                                ->where('invoice_id', $project->id)
                                ->sum('amount_paid');   @endphp
                                        <tr>
                                            <td>{{ \Carbon\Carbon::parse($project->case_start_date)->format('F d Y') }}</td>
                                            <td>INV000{{ optional($project->invoiveManage)->id ?? 'N/A'}}</td>
                                            <td>{{ $project->case_id ?? 'N/A'}}</td>
                                            <td>{{ optional($project->customer)->name ?? 'N/A'}}</td>
                                            <td>{{ $project->case_name ?? 'N/A'}}</td>
                                            <td>{{ optional($project->invoiveManage)->sub_total ?? 'N/A'}}</td>
                                            <td>{{ optional($project->invoiveManage)->sub_total * $project->invoiveManage->discount / 100 ?? 'N/A'}}</td>
                                           
                                            <td>{{ optional($project->invoiveManage)->total ?? 'N/A'}}</td>
        @endforeach
    </tbody>
</table>

</body>
</html>

