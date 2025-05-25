@include('layouts.header')
@include('layouts.sidebar')
@include('layouts.navbar')

<style>
.invoice-table th, .invoice-table td {
    border: 1px solid #ddd;
    padding: 10px;
    text-align: right;
}
.invoice-section {
    background-color: #f3f8ec; 
    padding: 15px;
    display: flex;
    justify-content: space-between; 
    align-items: start;
    border-radius: 5px;
    margin-top: 19px;
}
.bill-to{
    background: none !important; 
    flex: 1;
    padding: 15px;
}

.invoice-details {
background: none !important; 
    flex: 1; 
    /*padding: 15px;*/
    margin-left: 26%;
}

.invoice-title {
    color: #79a530;
    font-size: 32px;
    font-weight: bold;
}

.logo {
 width: 288px;
    margin-left: 24px;
    margin-top: 45px;
    height: auto;
}


.section {
    background-color: #f4f8eb;
    padding: 15px;
    margin-bottom: 20px;
    border-radius: 5px;
}

.invoice-table {
    width: 100%;
    border-collapse: collapse;
    margin-top: 20px;
}

.invoice-table th, .invoice-table td {
    border: 1px solid #ddd;
    padding: 10px;
    text-align: left;
}

.invoice-table th {
    background-color: #e9f1db;
    font-weight: bold;
}

.total-amount {
    text-align: right;
    font-size: 24px;
    font-weight: bold;
    color: #000;
    margin-top: 10px;
}

.header {
    display: flex;
    justify-content: center;
    align-items: center;
    flex-direction: column;
    border-bottom: 2px solid #ddd;
    padding-bottom: 20px;
    margin-bottom: 20px;
}
.header h1 {
    color: #7ab51d;
    margin-bottom: 5px;
}
.header img {
    max-width: 340px;
    margin-bottom: 13px;
    margin-top: 2%;
}
.section {
    margin-bottom: 20px;
}
.section h2 {
    font-size: 16px;
    margin-bottom: 10px;
    color: #666;
}
/*.invoice-details, .bill-to {*/
/*    background: #f3f8ec;*/
/*    padding: 15px;*/
/*}*/
table {
    width: 100%;
    border-collapse: collapse;
    margin-top: 20px;
}
table, th, td {
    border: 1px solid #ddd;
}
th, td {
    padding: 10px;
    text-align: left;
}
th {
    background-color: #f3f8ec;
}
.total {
    text-align: right;
    font-size: 18px;
    font-weight: bold;
}
.custom-table {
    width: 100%;
    border-collapse: collapse;
    font-family: Arial, sans-serif;
}
.custom-table th, .custom-table td {
    border: 1px solid #D84055;
    padding: 12px;
    text-align: left;
}
.custom-table th {
    background-color: #D84055;
    color: white;
    font-weight: bold;
}
.custom-table td {
    color: #333;
}
.action-icons {
    display: flex;
    gap: 8px;
}
.action-icons a {
    text-decoration: none;
    font-size: 16px;
    padding: 5px 8px;
    border-radius: 4px;
    color: white;
}
.delete-btn {
    background-color: #dc3545;
}
.tabs {
    display: flex;
    justify-content: center;
    margin-bottom: 20px;
    margin-top: 49px;
}
.tab {
    padding: 10px 20px;
    margin: 0 10px;
    border: 2px solid #e45757;
    border-radius: 5px;
    cursor: pointer;
    color: #e45757;
    font-weight: bold;
    transition: background-color 0.3s, color 0.3s;
}
.tab.active {
    background-color: #e45757;
    color: white;
}
.project-card{
    background-color:#FDF5F6 !important; 
    border:1px solid #D8405533;
    border-radius: 12px;
}
.project-card p {
    margin: 0;
    font-size: 14px;
}
.project-card .btn {
    background-color: #ff5252;
    color: #fff;
    border: none;
    border-radius: 4px;
}
.project-card .btn:hover {
    background-color: #e60000;
}

/* PDF Download Button styling */
.pdf-download-btn {
    background-color: #28a745;
    color: #fff;
    padding: 10px 20px;
    border-radius: 5px;
    text-decoration: none;
    font-weight: bold;
    float: right;
    margin-top: 10px;
}
.pdf-download-btn:hover {
    background-color: #218838;
}

/* Hide elements in PDF snapshot if needed */
.hide-in-pdf {
    /* You can add CSS rules to hide specific elements in PDF snapshot if required */
}


.invoice-headertbl td{
    padding: 2px;
    border: none;
}
/**/
.custom-btn {
    color: #D84055;
    border: 2px solid #D84055;
    background-color: white;
    padding: 10px 20px;
    font-size: 16px;
    cursor: pointer;
    transition: all 0.3s ease;
    margin-left: 11px;
    margin-right: 39px;
}
.custom-btn:focus, .custom-btn:active {
    outline: none;
    box-shadow: none;
    background-color: #D84055;
    color: #fff;
    border-color: #D84055;
}
.custom-btn:hover {
    color: #fff;
    background-color: #D84055;
    border-color: #D84055;
}
</style>     

<div class="container-fluid" id="container-wrapper">
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800" style="color:black !important; font-weight: 600; font-size: 28px;">
            <a href="{{ route('invoice-list') }}" style="text-decoration: none; color: black;">Invoice & Payment /</a><span style="color:black !important; font-weight: 600; font-size: 22px;"> View</span>
        </h1>
         
        <a href="javascript:void(0)" onclick="downloadPDF()" class="btn custom-btn mb-3"><i class="fas fa-file-pdf"></i> PDF</a>
        
          <!--<a href="{{ route('invoice.download',$invoicePayment->id) }}" class="btn custom-btn mb-3">-->
          <!--              <i class="fas fa-file-pdf"></i> PDF-->
          <!--          </a>-->
    </div>

    <!-- Invoice Summary Container (for PDF capture) -->
     <div id="invoice-pdf">
        <div class="card mb-4" style="box-shadow: 0 4px 8px rgba(216, 64, 85, 0.5) !important; padding: 20px;">
            <div class="d-flex justify-content-between align-items-start">
                <div class="invoice-logo">
                    <img src="{{ asset('assets/img/applogo.png') }}" alt="Logo" class="logo">
                </div>
                <div>
                    <h1 class="invoice-title" style="color: #5e9732;">INVOICE</h1>
                
                    <table class="invoice-headertbl"  style="width: 78%; border-collapse: collapse; border: none;">
                        <tr>
                            <td style="vertical-align: top; font-weight: bold; width: 53px; color:#5e9732;">Add.:</td>
                            <td>
                                ABATEMENT SOLUTIONS LLC<br>
                                155 Bellamy Rd, Cheshire, CT 06410
                            </td>
                        </tr>
                        <tr>
                            <td style="vertical-align: top; font-weight: bold; color:#5e9732;">Email:</td>
                            <td>prit@abatementsolutionsllc.com</td>
                        </tr>
                        <tr>
                            <td style="vertical-align: top; font-weight: bold; color:#5e9732; ">Mob.:</td>
                            <td>+1 (203) 672-1336</td>
                        </tr>
                        <tr>
                            <td style="vertical-align: top; font-weight: bold; color:#5e9732;">Web.:</td>
                            <td>www.abatementsolutionsllc.com</td>
                        </tr>
                    </table>
                </div>

            </div>

            <div class="invoice-section">
                <div class="bill-to">
                    <h2>Bill to</h2>
                    <p><strong style="color:#5e9732;">Customer Name: </strong><strong>{{ $invoicePayment->projects->customer->name ?? 'N/A' }}</strong><br>
                      <strong style="color:#5e9732;">Business Type: </strong> {{ $invoicePayment->projects->customer->business_type ?? 'N/A' }}<br>
                       <strong style="color:#5e9732;">Ref:</strong> {{ $invoicePayment->projects->customer->address ?? 'N/A'}}</p>
                </div>
            
                <div class="invoice-details">
                    <h2>Invoice details</h2>
                    <p>
                        <strong style="color:#5e9732;">Invoice no.: </strong> 00{{ $invoicePayment->id ?? 'N/A'}}<br>
                        <strong style="color:#5e9732;">Case ID/Job Number:- </strong>{{ $invoicePayment->projects->case_id ?? 'N/A'}}<br>
                        <strong style="color:#5e9732;">Invoice date: </strong> {{ \Carbon\Carbon::parse($invoicePayment->created_at)->format('F d Y') ?? 'N/A'}}<br>
                        <strong style="color:#5e9732;">Date of Service: </strong> {{ \Carbon\Carbon::parse($invoicePayment->projects->case_start_date)->format('F d Y') ?? 'N/A' }}<br>
                        <strong style="color:#5e9732;">Service Type: </strong> {{ $invoicePayment->projects->case_type ?? 'N/A' }}
                    </p>
                </div>
            </div>

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
        
        <div class="card-footer text-right">
                <a href="{{route('invoice-list')}}" class="btn btn-secondary">Back to Invoice List</a>
            </div>
        </div>
        
        
    
    <!-- Modal Logout -->
    <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabelLogout"
         aria-hidden="true">
         <div class="modal-dialog" role="document">
             <div class="modal-content">
                 <div class="modal-header">
                     <h5 class="modal-title" id="exampleModalLabelLogout">Ohh No!</h5>
                     <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                         <span aria-hidden="true">&times;</span>
                     </button>
                 </div>
                 <div class="modal-body">
                     <p>Are you sure you want to logout?</p>
                 </div>
                 <div class="modal-footer">
                     <button type="button" class="btn btn-outline-primary" data-dismiss="modal">Cancel</button>
                     <form action="{{ url('logout') }}" method="POST">
                         @csrf
                         <button type="submit" class="btn btn-primary">Logout</button>
                     </form>
                 </div>
             </div>
         </div>
    </div>
</div>
</div>
@include('layouts.footer')

<script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.5.1/jspdf.umd.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/html2canvas/1.4.1/html2canvas.min.js"></script>
<script>
    function downloadPDF() {
    const element = document.getElementById('invoice-pdf');
    const backButton = element.querySelector('.card-footer');

    backButton.style.display = 'none';

    html2canvas(element, { scale: 2 }).then(canvas => {
        const imgData = canvas.toDataURL('image/png');
        const { jsPDF } = window.jspdf;
        const pdf = new jsPDF('p', 'pt', 'a4');
        const pdfWidth = pdf.internal.pageSize.getWidth();
        const pdfHeight = pdf.internal.pageSize.getHeight();

        const imgProps = pdf.getImageProperties(imgData);
        const imgRatio = imgProps.width / imgProps.height;
        let printedHeight = pdfWidth / imgRatio;
        if (printedHeight > pdfHeight) {
            printedHeight = pdfHeight;
        }

        pdf.addImage(imgData, 'PNG', 0, 0, pdfWidth, printedHeight);
        pdf.save('invoice.pdf');

        backButton.style.display = '';
    });
}

</script>
