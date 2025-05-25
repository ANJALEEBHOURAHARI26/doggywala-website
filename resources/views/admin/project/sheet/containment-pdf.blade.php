<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Containment Sheet</title>
    <style>
        body {
            font-family: DejaVu Sans, sans-serif;
        }
        #header {
            text-align: center;
            margin-bottom: 10px;
            margin-left:50px !important;
            margin-right:50px !important;
            margin-top:50px !important;
        }
        #header img {
            width: 550px;
        }
        .company-info {
            font-weight: bold;
        }
        .title {
            text-align: center;
            
            margin-top: 10px;
            margin-bottom: 10px;
            text-decoration: underline;
        }
        .meta-table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 15px;
        }
        .meta-table td, .meta-table th {
            border: 1px solid #D84055;
            padding: .75rem;
        }
        .entry-table {
            width: 100%;
            border-collapse: collapse;
        }
        .entry-table th, .entry-table td {
            border: 1px solid #D84055;
            padding: .75rem;
            text-align: center;
        }
        .entry-table th {
            background-color: #fff;
        }
        .footer {
            text-align: center;
            font-size: 10px;
            margin-top: 20px;
        }
        th {
            background-color: #fff;
        }
        td {
            background-color: #fff;
        }
    </style>
</head>
<body>

<div   id="header">
    <img src="{{ asset('assets/img/applogo.png') }}" alt="Logo" style="height:200px;width: 550px;margin-top: 27px;">

    <div class="company-info" style="font-size:25px;">
        Abatement Solutions LLC<br>
        155 Bellamy Road, Cheshire, CT 06410, Ph: 203-672-1336
    </div>
</div>

<div class="title" style="padding-top: 18px;font-size:40px !important;">Containment Sheet</div>

    <div id="pdf-content" style="padding-left: 25px; padding-right: 25px;">
    <table class="table table-striped table-bordered mt-4 text-center meta-table">
        <tr>
            <th style="width:30%;text-align: center;font-size:25px;">Date:</th>
            <td style="font-size:25px;">{{ \Carbon\Carbon::parse($containmentDetails->date)->format('F d, Y') }}</td>
        </tr>
        <tr>
            <th style="width:30%;text-align: center;font-size:25px;">Supervisor Name:</th>
            <td style="font-size:25px;">{{ $containmentDetails->supervisor_name ?? 'N/A' }}</td>
        </tr>
        <tr>
            <th style="width:30%;text-align: center;font-size:25px;"> Job Location:</th>
            <td style="font-size:25px;">{{ $containmentDetails->job_location ?? 'N/A' }}</td>
        </tr>
        <tr>
            <th style="width:30%;text-align: center;font-size:25px;"> Job Number:</th>
            <td style="font-size:25px;">{{ $containmentDetails->job_number ?? 'N/A' }}</td>
        </tr>
    </table>
</div>

 <div style="padding-left: 20px; padding-right: 20px;">
    <table class="entry-table"> 
    <thead>
        <tr>
            <th style="font-size:25px;">Name<br>(Last 4 SSN)</th>
            <th style="font-size:25px;">Representing<br>Company</th>
            @for ($i = 1; $i <= 5; $i++)
                <th style="font-size:25px;" >Time In</th>
                <th style="font-size:25px;">Time Out</th>
            @endfor
        </tr>
    </thead>
   <tbody>
    @php
        $grouped = $containmentEntry->groupBy(function($item) {
            return $item->ssn_last . '_' . $item->representing_company;
        });
    @endphp

    @foreach ($grouped as $key => $entries)
        <tr>
            <td style="font-size:25px;">{{ $entries->first()->ssn_last }}</td>
            <td style="font-size:25px;">{{ $entries->first()->representing_company }}</td>
            @foreach ($entries->take(5) as $entry)
                <td style="font-size:25px;">{{ \Carbon\Carbon::parse($entry->time_in)->format('h:i A') }}</td>
                <td style="font-size:25px;">{{ \Carbon\Carbon::parse($entry->time_out)->format('h:i A') }}</td>
            @endforeach

            {{-- Blank columns agar 5 se kam time entries ho --}}
            @for ($i = $entries->count(); $i < 5; $i++)
                <td style="font-size:25px;"></td>
                <td style="font-size:25px;"></td>
            @endfor
        </tr>
    @endforeach
    
    
</tbody>
 
</table>
</div>
 <div style="text-align: center; margin-top: 40px; font-size: 16px;">
                      <a href="https://www.abatementsolutionsllc.com" target="_blank" style="color: #fc544b; text-decoration: underline;">https://www.abatementsolutionsllc.com</a>
                    </div> 
</body>
</html>
