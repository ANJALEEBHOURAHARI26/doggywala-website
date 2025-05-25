@include('layouts.header')
@include('layouts.sidebar')
@include('layouts.navbar')

<style>
.editing {
        border: 2px solid #007bff;
        padding: 5px;
        background-color: #f0f8ff;
    }
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
                                           value="{{ \Carbon\Carbon::parse($invoiceData->created_at)->format('M d Y') }}">
                                            

                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label>Payment Type</label>
                                    <input type="text" class="form-control" readonly
                                           value="{{ $invoiceData->payment_type ?? 'N/A' }}">
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label>Sub Total Amount</label>
                                    <input id="subtotalamt" type="text" class="form-control" readonly
                                           value="${{ $invoiceData->sub_total ?? 'N/A' }}">
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label>Discount({{ $invoiceData->discount ?? '0' }}%)</label>
                                    <input type="text" class="form-control" readonly
                                           value="{{$invoiceData->sub_total * $invoiceData->discount / 100}}">
                                </div>
                            </div>
                           
                        </div>
                        <div class="row mt-4">
                             @php
                             $get_total = $invoiceData->sub_total - $invoiceData->sub_total * $invoiceData->discount / 100;
                             @endphp
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label>Tax({{ round($invoiceData->tax / $get_total * 100, 2) ?? '0' }}%)</label>
                                    <input type="text" class="form-control" readonly
                                           value="{{$invoiceData->tax}}">
                                </div>
                            </div>
                            <!-- Net Total Amount -->
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label>Net Total Amount</label>
                                    <input id="net_total_amt" type="text" class="form-control" readonly
                                           value="${{ $invoiceData->total }}">
                                </div>
                            </div>
                            @php
                            $casedata = \DB::table('projects')->where('id', $invoiceData->case_id)->first(); 
                            @endphp
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label>Case ID/Job Number</label>
                                    <input type="text" class="form-control" readonly
                                           value="{{ $casedata->case_id }}">
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label>Customer Name</label>
                                    <input type="text" class="form-control" readonly
                                           value="{{ $invoiceData->customer_name }}">
                                </div>
                            </div>
                        </div>

                        

                        <hr>

                        <h5>Payment History</h5>
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>Paid Amount</th> 
                                    <th>Payment Mode</th>
                                    <th>Description</th>
                                    <th>Date</th>
                                </tr>
                            </thead>
                            <tbody>
@php $totalpaidamt = 0; @endphp
@foreach($invoicePayment as $l)
 @php $totalpaidamt += $l->amount_paid; @endphp
<tr data-id="{{ $l->id }}">
    <td class="editable" data-name="amount_paid" data-id="{{ $l->id }}" contenteditable="false">${{ $l->amount_paid }}</td>
     
    <td>{{ $l->payment_mode }}</td>
    <td class="editable" data-name="discription" data-id="{{ $l->id }}" contenteditable="false">{{ $l->discription }}</td>
    <td>{{ \Carbon\Carbon::parse($l->created_at)->format('M d Y - h:i A') ?? 'N/A' }}</td>
    <td><button style="border: unset;background: white;" class="edit-btn"> <img src="{{ asset('assets/img/Edit-Icon.png') }}" alt="Edit"></button></td>
</tr>
@endforeach
</tbody>
                                <tr>
                                    <th id="totalPaidDisplay">Total Paid Amount (${{ $totalpaidamt }})</th> 
                                    <th></th>
                                    <th></th></th>
                                    <th></th>
                                </tr>


                        </table>

                         
                    </div>
                    
                    <div class="row">
                        <div class="card-footer" style="margin-left: 56%;">
                            <a href="{{ route('get-invoices-view', $invoiceData->id) }}" class="btn btn-secondary hide-in-pdf" id="invoice-back-button">
                                View Invoice
                            </a>
                             
                            <a href="{{ route('get-invoices-detail') }}" class="btn btn-secondary hide-in-pdf" id="back-button">
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
<div id="success-toast" style="
    display: none;
    position: fixed;
    top: 20px;
    right: 20px;
    background-color: #4CAF50;
    color: white;
    padding: 16px 24px;
    border-radius: 4px;
    box-shadow: 0 4px 8px rgba(0,0,0,0.2);
    z-index: 9999;
    font-weight: bold;
">
    Successfully Updated
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
     
document.addEventListener('DOMContentLoaded', function () {
    // Make only one row editable on Edit button click
    document.querySelectorAll('.edit-btn').forEach(button => {
        button.addEventListener('click', function () {
            // Disable all editable fields globally
            document.querySelectorAll('.editable').forEach(cell => {
                cell.contentEditable = false;
                cell.classList.remove('editing');
            });

            // Enable editable for current row only
            const row = this.closest('tr');
            row.querySelectorAll('.editable').forEach(cell => {
                cell.contentEditable = true;
                cell.classList.add('editing');

                // Store old value for validation later
                if (cell.dataset.name === 'amount_paid') {
                    let oldVal = parseFloat(cell.innerText.trim().replace('$', '')) || 0;
                    cell.setAttribute('data-old-value', oldVal);
                }
            });
        });
    });

    // On blur, send AJAX update for just that cell
    document.querySelectorAll('.editable').forEach(cell => {
        cell.addEventListener('blur', function () {
            if (!this.classList.contains('editing')) return;

            const id = this.dataset.id;
            const column = this.dataset.name;
            let value = this.innerText.trim().replace('$', '');

            if ((column === 'amount_paid' || column === 'amount_due') && isNaN(value)) {
                showErrorToast('Please enter a valid number');
                this.focus();
                return;
            }

            value = parseFloat(value);
            if (isNaN(value)) value = 0;

            // Get old value and current total from displayed total
            const oldVal = parseFloat(this.getAttribute('data-old-value')) || 0;
            const totalPaidDisplay = parseFloat(
                document.getElementById('totalPaidDisplay').textContent.replace(/[^\d.]/g, '')
            ) || 0;

            const total = totalPaidDisplay - oldVal + value;

            // Get subtotal
            const subtotal = parseFloat(document.getElementById('subtotalamt').value.replace('$', '')) || 0;
                  const net_total_amt = parseFloat(document.getElementById('net_total_amt').value.replace('$', '')) || 0;
             
            if (total > net_total_amt) {
                showErrorToast('Total paid amount cannot exceed subtotal!');
                this.innerText = `$${oldVal.toFixed(2)}`;
                this.focus();
                return;
            }

            // Send the updated value to the server
            fetch(`/update-invoice-cell`, {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                },
                body: JSON.stringify({ id, column, value })
            })
            .then(res => res.json())
            .then(res => {
                console.log('Updated', res);
                showToast('✔ Successfully Updated');

                // Update old value
                this.setAttribute('data-old-value', value);

                // Update totalPaidDisplay
                document.getElementById('totalPaidDisplay').textContent = `Total Paid Amount ($${total.toFixed(2)})`;
            })
            .catch(err => {
                console.error('Error:', err);
                showErrorToast('Failed to update. Please try again.');
            });

            this.contentEditable = false;
            this.classList.remove('editing');
        });
    });

    // Only allow numbers in amount_paid and amount_due fields
    document.querySelectorAll('.editable').forEach(cell => {
        cell.addEventListener('keypress', function (e) {
            const column = this.dataset.name;
            if ((column === 'amount_paid' || column === 'amount_due') && !/[0-9.]/.test(e.key)) {
                e.preventDefault();
            }
        });
    });
});

 
function showToast(message) {
    const toast = document.getElementById('success-toast');
    toast.textContent = message;
    toast.style.backgroundColor = '#28a745'; // Green
    toast.style.color = '#fff';
    toast.style.display = 'block';
    setTimeout(() => {
        toast.style.display = 'none';
    }, 3000);
}

 
function showErrorToast(message) {
    const toast = document.getElementById('success-toast');
    toast.textContent = message;
    toast.style.backgroundColor = '#dc3545'; // Red
    toast.style.color = '#fff';
    toast.style.display = 'block';
    setTimeout(() => {
        toast.style.display = 'none';
    }, 4000);
}
</script>
