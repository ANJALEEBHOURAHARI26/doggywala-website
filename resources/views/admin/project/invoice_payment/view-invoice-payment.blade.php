@include('layouts.header')
@include('layouts.sidebar')
@include('layouts.navbar')

<style>
.table-bordered {
    border: 3px solid #a0a2ab;
}
.table-bordered td, .table-bordered th {
    border: 1px solid #717376;
}
.table thead th {
    vertical-align: bottom;
    border-bottom: 2px solid #1b1b1c;
}
    th {
        color: black;
    }
    td {
        color: #545151;
    }
    .download-btn {
        background-color: #28a745;
        color: white;
        padding: 10px 15px;
        border-radius: 5px;
        text-decoration: none;
        font-weight: bold;
    }
    .download-btn:hover {
        background-color: #218838;
        color: white;
    }

    /* Company Logo bigger size */
    .company-logo {
        width: 389px;
        height: auto;
        margin-top: 3%;
    }

    #payment-summary .card {
        box-shadow: 0 4px 8px rgba(216, 64, 85, 0.5) !important;
        border: 1px solid #ddd;
        border-radius: 5px;
        margin-bottom: 20px;
    }
    #payment-summary .card-header {
        background: linear-gradient(90deg, #3136C1 0%, #D84055 100%); border: none;
        font-size: 20px;
        font-weight: bold;
    }

    .hide-in-pdf {
    }
</style>

<div class="container-fluid">
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 text-gray-800" style="color:black !important; font-weight: 600; font-size: 28px;">
            Invoice & Payment / <span style="color:black !important; font-weight: 600; font-size: 22px;">View Invoice & Payment</span>
        </h1>
        <a href="javascript:void(0)" onclick="downloadPDF()" class="btn btn-primary">Download Payment Summary</a>
    </div>

    <div class="row justify-content-center">
        <div class="col-md-12">
            <!-- Wrap the card inside a container to capture its content -->
            <div id="payment-summary">
                <div class="card">
                    <div class="card-header text-white">
                        Invoice & Payment Details
                    </div>
                    <div class="card-body">
                        <!-- Company Header -->
                        <div class="header text-center">
                            <!-- Bigger Logo -->
                            <img src="https://abatementsolutionsllc.sunshinedemo.xyz/assets/img/applogo.png" alt="Company Logo" class="company-logo">
                            <h2 style="margin-top: 10px;">Abatement Solutions LLC</h2>
                            <h3>Payment Summary</h3>
                        </div>

                        <!-- FORM-STYLE ROW (Date, Payment Type, Total Amount) -->
                        <div class="row mt-4">
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label>Date</label>
                                    <input type="text" class="form-control" readonly
                                           value="{{ \Carbon\Carbon::parse($invoicePayment->created_at)->format('F d Y') ?? 'N/A' }}">
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label>Payment Type</label>
                                    <input type="text" class="form-control" readonly
                                           value="{{ $invoicePayment->payment_type ?? 'N/A' }}">
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label>Sub Total Amount</label>
                                    <input type="text" class="form-control" readonly
                                           value="${{ $invoicePayment->final_amount ?? 'N/A' }}">
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label>Discount({{ $invoicePayment->discount ?? '0' }}%)</label>
                                    <input type="text" class="form-control" readonly
                                           value="${{ number_format(($invoicePayment->final_amount * ($invoicePayment->discount / 100)), 2) }}">
                                </div>
                            </div>
                           
                        </div>
                        <div class="row mt-4">
                            <!-- Discount -->
                            <!--<div class="col-md-3">-->
                            <!--    <div class="form-group">-->
                            <!--        <label>Discount({{ $invoicePayment->discount ?? '0' }}%)</label>-->
                            <!--        <input type="text" class="form-control" readonly-->
                            <!--               value="${{ number_format(($invoicePayment->final_amount * ($invoicePayment->discount / 100)), 2) }}">-->
                            <!--    </div>-->
                            <!--</div>-->
                        
                            <!-- Net Total Amount -->
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label>Net Total Amount</label>
                                    <input type="text" class="form-control" readonly
                                           value="${{ $invoicePayment->net_amount }}">
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label>Case ID/Job Number</label>
                                    <input type="text" class="form-control" readonly
                                           value="{{ $invoicePayment->projects->case_id }}">
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label>Customer Name</label>
                                    <input type="text" class="form-control" readonly
                                           value="{{ $invoicePayment->projects->customer->name }}">
                                </div>
                            </div>
                        </div>

                        

                        <hr>

                        <h5>Payment History</h5>
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>Pay Amount</th>
                                    <th>Due Amount</th>
                                    <th>Payment Mode</th>
                                    <th>Description</th>
                                    <th>Date</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($invoicePayment->duePayments as $duePayment)
                                    <tr>
                                        <td>${{ $duePayment->pay_amount }}</td>
                                        <td>${{ $duePayment->due_amount }}</td>
                                        <td>{{ $duePayment->payment_mode }}</td>
                                        <td>{{ $duePayment->description ?? 'N/A' }}</td>
                                        <td>{{ \Carbon\Carbon::parse($duePayment->created_at)->format('M d Y - h:i A') ?? 'N/A' }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>

                        @if($isInvoiceClosed)
                            <div class="alert alert-success mt-3">
                                <strong>Invoice Closed!</strong> All due amounts are paid.
                            </div>
                        @endif
                    </div>
                    
                    <div class="row">
                        <div class="card-footer" style="margin-left: 56%;">
                            <a href="{{ route('invoice-View', $invoicePayment->id) }}" class="btn btn-secondary hide-in-pdf" id="invoice-back-button">
                                View Invoice
                            </a>
                            <a href="{{ route('project-invoice', $invoicePayment->project_id) }}" class="btn btn-secondary hide-in-pdf" id="back-button">
                                Back to Invoice Payment List
                            </a>
                        </div>
    
                        <div class="card-footer">
                            
                        </div>
                    </div>
                </div>
            </div>
            
            <!-- Logout Modal -->
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
            <!-- End Logout Modal -->

        </div>
    </div>
</div>

@include('layouts.footer')

<script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.5.1/jspdf.umd.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/html2canvas/1.4.1/html2canvas.min.js"></script>
<script>
    function downloadPDF() {
        const backBtn = document.getElementById('back-button');
        const invoiceBackBtn = document.getElementById('invoice-back-button');
        if(backBtn) backBtn.style.display = 'none';
        if(invoiceBackBtn) invoiceBackBtn.style.display = 'none';

        const { jsPDF } = window.jspdf;
        const element = document.getElementById('payment-summary');

        html2canvas(element, { scale: 2 }).then(canvas => {
            const imgData = canvas.toDataURL('image/png');
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
            pdf.save('payment_summary.pdf');

            if(backBtn) backBtn.style.display = 'inline-block';
            if(invoiceBackBtn) invoiceBackBtn.style.display = 'inline-block';
        });
    }
</script>
