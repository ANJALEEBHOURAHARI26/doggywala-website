<!DOCTYPE html>
<html>
<head>
    <title>Invoice</title>
    <style>
    body {
        font-family: 'DejaVu Sans', sans-serif;
        color: #000;
        margin: 0;
        padding: 0;
    }

    .invoice-box {
        max-width: 850px;
        margin: auto;
        padding: 30px;
        border: 1px solid #eee;
        background: #fff;
    }

    .logo {
        width: 200px;
    }

    h1.invoice-title {
        color: #5e9732;
        font-size: 32px;
        font-weight: bold;
        margin-top: 0;
    }

    h2 {
        font-size: 16px;
        color: #6d9e1f;
        margin-bottom: 10px;
    }

    table {
        width: 100%;
        border-collapse: collapse;
        margin-top: 20px;
    }

    th, td {
        border: 1px solid #ddd;
        padding: 8px;
        text-align: center;
    }

    th {
        background-color: #ecf3df;
        font-weight: bold;
    }

  .invoice-section {
    background-color: #f3f8ec;
    padding: 15px 20px;
    display: flex;
    justify-content: space-between;
    align-items: flex-start;
    border-radius: 8px;
    margin-top: 20px;
}

.bill-to {
    width: 48%;
    text-align: left;
}

.invoice-details {
    width: 48%;
    text-align: right;
}



    .invoice-headertbl td {
        padding: 2px;
        border: none;
        font-size: 13px;
    }

    .total {
        font-weight: bold;
        font-size: 18px;
        text-align: right;
    }

    .discount {
        color: red;
        text-align: center;
    }

    .footer {
        margin-top: 20px;
        text-align: center;
        font-size: 12px;
        color: #999;
    }
</style>

</head>
<body>
    <div class="container-fluid" id="container-wrapper">
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800" style="color:black !important; font-weight: 600; font-size: 28px;">
            <a href="{{ route('invoice-list') }}" style="text-decoration: none; color: black;">Invoice & Payment /</a><span style="color:black !important; font-weight: 600; font-size: 22px;"> View</span>
        </h1>
        <!-- PDF Download Button -->
        <!--<a href="javascript:void(0)" onclick="downloadPDF()" class="btn btn-primary">Download Invoice PDF</a>-->

    </div>

    <!-- Invoice Summary Container (for PDF capture) -->
     <div id="invoice-pdf">
        <div class="card mb-4" style="box-shadow: 0 4px 8px rgba(216, 64, 85, 0.5) !important; padding: 20px;">
<table style="width: 100%; border-collapse: collapse; margin-bottom: 20px;border:none;">
    <tr>
        <!-- Left Side: Logo & Tagline -->
        <td style="width: 50%; vertical-align: top;border: none;">
            <div style="margin-bottom: 10px;">
                <img src="{{ asset('assets/img/applogo.png') }}" alt="Logo" style="max-height: 80px;">
            </div>
            <div style="color: #c42847; font-style: italic; font-weight: 500; font-size: 14px;">
                Effortless Abatement, Enduring Safety.
            </div>
        </td>

        <!-- Right Side: Invoice title & Contact -->
        <td style="width: 50%; vertical-align: top; text-align: left;border: none;">
            <h2 style="color: #5e9732; margin-bottom: 10px; font-size:32px;">INVOICE</h2>

            <table style="width: 100%; border-collapse: collapse; font-size: 14px; text-align: right;border: none;">
                <tr>
                    <td style="color: #5e9732; font-weight: bold;border: none;">Add.:</td>
                    <td style="text-align: left; padding-left: 10px;border: none;">
                        ABATEMENT SOLUTIONS LLC<br>
                        155 Bellamy Rd, Cheshire, CT 06410
                    </td>
                </tr>
                <tr>
                    <td style="color: #5e9732; font-weight: bold;border: none;">Email:</td>
                    <td style="text-align: left; padding-left: 10px;border: none;">prit@abatementsolutionsllc.com</td>
                </tr>
                <tr>
                    <td style="color: #5e9732; font-weight: bold;border: none;">Mob.:</td>
                    <td style="text-align: left; padding-left: 10px;border: none;">+1 (203) 672-1336</td>
                </tr>
                <tr>
                    <td style="color: #5e9732; font-weight: bold;border: none;">Web.:</td>
                    <td style="text-align: left; padding-left: 10px;border: none;">www.abatementsolutionsllc.com</td>
                </tr>
            </table>
        </td>
    </tr>
</table>


            <table style="width: 100%; background-color: #f3f8ec; padding: 15px; border:none;">
    <tr>
        <td style="width: 50%; vertical-align: top;text-align: left;border: none;">
            <h2 style="color: #5e9732;">Bill to</h2>
            <p>
                <strong style="color:#5e9732;">Customer Name: </strong><strong>Anjali</strong><br>
                <strong style="color:#5e9732;">Business Type: </strong>Individual<br>
                <strong style="color:#5e9732;">Ref: </strong>Vijay Nagar
            </p>
        </td>
        <td style="width: 50%; vertical-align: top; text-align: right;border: none;">
            <h2 style="color: #5e9732;">Invoice details</h2>
            <p>
                <strong style="color:#5e9732;">Invoice no.: </strong>0012<br>
                <strong style="color:#5e9732;">Case ID/Job Number:- </strong>CASE029<br>
                <strong style="color:#5e9732;">Invoice date: </strong>April 18 2025<br>
                <strong style="color:#5e9732;">Date of Service: </strong>April 19 2025<br>
                <strong style="color:#5e9732;">Service Type: </strong>Testing
            </p>
        </td>
    </tr>
</table>



            <table class="invoice-table mt-4" style="width: 100%; border-collapse: collapse;">
                <tr>
                    <th style="text-align:center;">#</th>
                    <th style="text-align:center;">Date</th>
                    <th style="text-align:center;">Product or service</th>
                    <th style="text-align:center;">Description</th>
                    <th style="text-align:center;">Amount</th>
                </tr>
                <tr>
                    <td style="text-align:center;">1</td>
                    <td style="text-align:center;">{{ \Carbon\Carbon::parse($invoicePayment->created_at)->format('m/d/Y') ?? 'N/A' }}</td>
                    <td style="text-align:center;"><strong>{{ $invoicePayment->projects->case_name ?? 'N/A' }}</strong></td>
                    <td style="text-align:center;">{{ $invoicePayment->description ?? 'N/A' }}</td>
                    <td style="text-align:center;">{{ number_format($invoicePayment->final_amount, 2) ?? 'N/A' }}</td>
                </tr>
            
                <!-- Sub Total Row -->
                <tr>
                    <td colspan="4" style="text-align:right; font-weight:bold; padding: 10px;">Sub Total:</td>
                    <td style="text-align:center;">{{ number_format($invoicePayment->final_amount, 2) }}</td>
                </tr>
            
                <!-- Discount Row -->
                <tr>
                    <td colspan="4" style="text-align:right; font-weight:bold; padding: 10px;">Discount ({{ $invoicePayment->discount ?? '0' }}%):</td>
                    <td style="text-align:center; color:red;"> ${{ number_format(($invoicePayment->final_amount * ($invoicePayment->discount / 100)), 2) }}</td>
                </tr>
            
                <!-- Total Row -->
                <tr>
                    <td colspan="4" style="text-align:right; font-weight:bold; font-size: 18px; padding: 10px;">Total:</td>
                    <td style="text-align:center; font-weight:bold; font-size: 18px;">${{ number_format($invoicePayment->net_amount, 2) }}</td>
                </tr>
            </table>


            <!--<p class="total-amount text-right mt-3"><strong>Total: ${{$invoicePayment->final_amount ?? 'N/A'}}</strong></p>-->

        </div>
        
        
    
    <!-- Modal Logout -->
    
</div>
</div>
</body>
</html>
