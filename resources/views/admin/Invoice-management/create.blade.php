@include('layouts.header')
    @include('layouts.sidebar')
        @include('layouts.navbar')
        <!-- In your blade file (usually in layout file) -->
<!-- Select2 CSS -->
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />

<!-- jQuery (if not already included) -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<!-- Select2 JS -->
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

 <style>
    .select2-container {
    width: 100% !important;
}

.select2-selection {
    height: 41px !important;
    font-size: 16px !important;
    border: 2px solid #ccc !important;
    border-radius: 5px !important;
    padding: 4px !important;
    background-color: #FDF5F6 !important;
    border-color: #D8405533 !important;
}
.text-danger-error{
    color:#fc544b !important;
    font-size: 0.9rem;
}
.table thead th {
    border-bottom: 2px solid black;
    background-color:#FDF5F6; 
    
}
.table-bordered td, .table-bordered th {
    border: 1px solid black;
}
.text-danger-error{
    color:#fc544b !important;
    font-size: 0.9rem;
}

 </style>       
 <div class="container-fluid" id="container-wrapper">
          <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800" style=" color:black !important; font-weight: 600; font-size: 28px;" >Invoice Manage/<span style=" color:black !important; font-weight: 600; font-size: 22px;">Add Invoice</span></h1>
          </div>

          <div class="row" >
            <div class="col-lg-12">
              <!-- Add Customer Form -->
              <div class="card mb-4" style="box-shadow: 0 4px 8px rgba(216, 64, 85, 0.5) !important;">
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                
                </div>
                <div class="card-body">
                    @if (session('success'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        {{ session('success') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
@endif

                    @if (session('error'))
                        <div class="alert alert-danger">
                            {{ session('error') }}
                        </div>
                    @endif
                    
                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                    
                    <form action="{{ route('store-invoicemanage') }}" method="POST" id="customerForm">
                        @csrf
                        <div class="form-row">
                            <div class="form-group col-md-4">
                            <label for="customerName">Case id <span class="text-danger">*</span></label>
                            <select class="form-control select2-case" name="case_id" style="background-color:#FDF5F6; border-color:#D8405533;">
                                <option value="">Select Case id</option>
                                @foreach($caseId as $cas)
                                    <option value="{{ $cas->id }}">{{ $cas->case_id }}</option>
                                @endforeach
                            </select>
                            <span class="text-danger-error"></span>
                        </div>

                    
                            <div class="form-group col-md-4">
                                <label for="emailAddress">Invoice Number</label>
                                <input type="text" class="form-control" id="invoiceNumber" name="invoice_number"
                                    style="background-color:#FDF5F6; border-color:#D8405533;" readonly>

                                <span id="emailError" class="text-danger"></span>
                                <span class="text-danger-error"></span>
                            </div>
                    
                            <div class="form-group col-md-4">
                                <label for="phoneNumber">Date<span class="text-danger">*</span></label>
                                <input type="date" class="form-control" id="invoicedate" name="date" placeholder=""
                                    value="" style="background-color:#FDF5F6; border-color:#D8405533;">
                                <span id="phoneError" class="text-danger"></span>
                            </div>
                        </div>
                    
                        <div class="form-row">
                            <div class="form-group col-md-4">
                                <label for="businessType">Payment type<span class="text-danger">*</span></label>
                                <select id="businessType" class="form-control" name="payment_type" style="background-color:#FDF5F6; border-color:#D8405533;">
                                    <option value="" disabled selected>Select Type...</option>
                                    <option value="Full">Full</option>
                                    <option value="Partial">Partial</option>
      
                                </select>
                                <span class="text-danger-error"></span>
                                <!--@error('business_type')-->
                                <!--    <div class="text-danger">{{ $message }}</div>-->
                                <!--@enderror-->
                            </div>
                    
                            <div class="form-group col-md-4">
                                <label for="country">Customer name</label>
                                <input type="text" class="form-control" id="customername" name="customer_name" value="USA" readonly
                                    style="background-color:#FDF5F6; border-color:#D8405533;">
                                    <input type="hidden" id="customer_id" name="customer_id">

                                <span class="text-danger-error"></span>
                            </div>
                            
                    
                            <div class="form-group col-md-4">
                                <label for="country">Service Type</label>
                                <input type="text" class="form-control" id="servicetype" name="service_type" value="USA" readonly
                                    style="background-color:#FDF5F6; border-color:#D8405533;">
                                <span class="text-danger-error"></span>
                            </div>
                        </div>
                    
<div class="container mt-4 p-4">

    <table class="table table-bordered" id="invoice-table">
        <thead>
            <tr>
                <th style="color:black;" >Product/Service</th>
                <th style="color:black;" >Description</th>
                <th style="color:black;" >Qty</th>
                <th style="color:black;" >Price</th>
                <th style="color:black;" >Amount</th>
                <th><button type="button" class="btn btn-sm btn-primary" id="addRow">Add</button></th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td><input type="text" class="form-control product" name="items[0][product]" id="itemname" style="background-color:#FDF5F6; border-color:#D8405533;"></td>
                <td><input type="text" class="form-control description" name="items[0][description]" style="background-color:#FDF5F6; border-color:#D8405533;"></td>
                <td><input type="number" class="form-control qty" value="1" name="items[0][qty]" style="background-color:#FDF5F6; border-color:#D8405533;"></td>
                <td><input type="number" class="form-control price" value="" name="items[0][price]" style="background-color:#FDF5F6; border-color:#D8405533;"></td>
                <td><input type="text" class="form-control amount" value="0" name="items[0][amount]" readonly style="background-color:#FDF5F6; border-color:#D8405533;"></td>
                <td><button type="button" class="btn btn-sm btn-danger removeRow"><i class="fas fa-trash"></i></button></td>
            </tr>
        </tbody>
    </table>

    <div class="row justify-content-end">
    <div class="col-md-7">
        <table class="table table-borderless">
            <tr>
                <th style="color: black;" ></th>
                 <th style="color: black;">
                      Sub Total</th>
                <td style="color: black;" ><span id="subTotal">$0</span></td>
            </tr>
           <tr>
            <th style="color: black;" style="width:27%;">Discount&nbsp%
            </th>
            <th style="color: black;">
                <input type="number" id="discountInput" value="0" min="0" name="discount" style="background-color:#FDF5F6; border-color:#D8405533; width: 70%; text-align: center;">
                </th>
    <td style="color: black;" class="d-flex align-items-center gap-2">
        <span id="discountValue" style="min-width: 60px;">$0.00</span>
    </td>
</tr>
<tr>
            <th style="color: black;" style="width:27%;">Tax&nbsp%
            </th>
            <th style="color: black;">
                <input type="number" id="taxInput" value="0" min="0" name="tax" style="background-color:#FDF5F6; border-color:#D8405533; width: 70%; text-align: center;">
                </th>
    <td style="color: black;" class="d-flex align-items-center gap-2">
        <span id="taxValue" style="min-width: 60px;">$0.00</span>
        <input type="hidden" id="taxValueInput" name="tax">
    </td>
</tr>

            <tr>
                <th style="color: black;" ></th>
                <th style="color: black;">Total
                      </th>
                <td style="color: black;" ><span id="total">$0</span></td>
            </tr>
            <tr>
                <th style="color: black;" ></th>
                <th style="color: black;">Amount Paid
                      </th>
                <td style="color: black;" ><input type="number" class="form-control" id="amountPaid" value="0" min="0" name="amount_paid" style="background-color:#FDF5F6; border-color:#D8405533;"></td>
            </tr>
            <tr>
                <th style="color: black;" ></th>
                <th style="color: black;">Payment Mode
                      </th>
                 <td style="color: black;" >
                                    <select id="businessType" class="form-control" name="payment_mode" style="background-color:#FDF5F6; border-color:#D8405533;">
                                    <option value="" disabled selected>Select Mode...</option>
                                    <!--<option value="Cash">Cash</option>-->
                                    <option value="Online">Online</option>
                                    <option value="Cheque">Cheque</option>
                                    <option value="Credit card">Credit card</option>
      
                                </select>
                                </td>
            </tr>
            <tr>
                <th style="color: black;" ></th>
                <th style="color: black;">Description
                      </th>
                <td style="color: black;" ><input type="text" class="form-control" style="background-color:#FDF5F6;border-color: #D8405533;padding: 8px;" name="description_manage" value=""  placeholder="Enter Description"></td>
            </tr>
            <tr>
                <th style="color: black;" ></th>
                <th style="color: black;">Amount Due
                      </th>
                <td style="color: black;" ><span id="amountDue">$0</span></td>
            </tr>
        </table>
    </div>
</div>

</div>

                    
                        <div class="text-center" style="text-align: right !important;">
                            <input type="hidden" name="sub_total" id="hiddenSubTotal">
                            <button type="submit" id="submitBtn" class="btn btn-danger"
                                style="background: linear-gradient(90deg, #3136C1 0%, #D84055 100%); border: none !important;width: 100px;">
                                Create
                            </button>
                        </div>
                    </form>
                </div>
              </div>
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
        <!---Container Fluid-->
      </div>
      <!-- Footer -->
      <footer class="sticky-footer bg-white">
        <div class="container my-auto">
          <div class="copyright text-center my-auto">
            <span>copyright &copy; <script> document.write(new Date().getFullYear()); </script> - Design & developed by
              <b><a href="https://www.sunshineitsolution.com/" target="_blank">Sunshine it Solution</a></b>
            </span>
          </div>
        </div>
      </footer>
      <!-- Footer -->
    </div>
  </div>

  <a class="scroll-to-top rounded" href="#page-top">
    <i class="fas fa-angle-up"></i>
  </a>
<!-- CSS for Select2 -->
<link href="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/css/select2.min.css" rel="stylesheet">

<!-- Required Scripts -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/4.6.0/js/bootstrap.bundle.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/js/select2.min.js"></script>
<!--<script src="https://cdn.jsdelivr.net/npm/jquery-validation@1.19.5/dist/jquery.validate.min.js"></script>  -->
<script src="https://cdn.jsdelivr.net/npm/jquery-validation@1.19.5/dist/jquery.validate.min.js"></script>
<script>
    $(document).ready(function () {

        // window.validateEmail = function (input) {
        //     const email = input.value;
        //     const error = document.getElementById("emailError");
        //     const regex = /^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/;

        //     error.textContent = regex.test(email) ? "" : "Please enter a valid email address (e.g., User@mail.com)";
        // };

        window.validatePhone = function (input) {
            let phone = input.value.replace(/\D/g, '');
            input.value = phone.slice(0, 10);
            const error = document.getElementById("phoneError");
            error.textContent = phone.length < 10 ? "" : "";
        };
        
        const allowedDomains = [
            'gmail.com', 'mail.com', 'yahoo.com', 'outlook.com', 'hotmail.com',
            'aol.com', 'icloud.com', 'zoho.com', 'protonmail.com', 'gmx.com'
        ];
        
    });
</script>
<script>
    function validateZipCode(input) {
        input.value = input.value.replace(/[^0-9]/g, '');

        if (input.value.length > 5) {
            input.value = input.value.slice(0, 5);
        }
    }
</script>
<script>
    // $(document).ready(function() {
    //     $('.select2-case').select2({
    //         placeholder: "Select Case id",
    //         allowClear: true,
    //         width: '100%'
    //     });
    // });
</script>
<script>
    let invoiceId = @json($invoiceId);
    console.log(invoiceId);

    document.addEventListener("DOMContentLoaded", function () {
        let date = "000";
        let invoiceNumber = "";

        if (!invoiceId || !invoiceId.invoice_number) {
            // Case: No invoice exists
            invoiceNumber = "INV0001";
        } else {
            // Extract last number, increment by 1
            let lastNumber = parseInt(invoiceId.invoice_number.replace("INV", ""));
            let newNumber = lastNumber + 1;

            // Pad with leading zeros (e.g. 5 => 0005)
            let paddedNumber = newNumber.toString().padStart(4, '0');

            invoiceNumber = "INV" + paddedNumber;
        }

        document.getElementById('invoiceNumber').value = invoiceNumber;
    });
</script>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<script>
    $(document).ready(function () {
        $('.select2-case').on('change', function () {
            var caseId = $(this).val();
            if (caseId) {
                $.ajax({
                    url: '/get-case-details/' + caseId,
                    type: 'GET',
                    success: function (data) {
                        $('#customername').val(data.customer_name);
                         $('#customer_id').val(data.customer_id); 
                        $('#servicetype').val(data.service_type);
                    },
                    error: function () {
                        alert('Something went wrong while fetching data!');
                    }
                });
            } else {
                $('#customername').val('');
                $('#servicetype').val('');
            }
        });
    });
</script>
<script>
    function calculate() {
    let subTotal = 0;
    $('#invoice-table tbody tr').each(function () {
        const qty = parseFloat($(this).find('.qty').val()) || 0;
        const price = parseFloat($(this).find('.price').val()) || 0;
        const amount = qty * price;
        $(this).find('.amount').val(amount.toFixed(2));
        subTotal += amount;
    });

    const discountPercent = parseFloat($('#discountInput').val()) || 0;
    const taxPercent = parseFloat($('#taxInput').val()) || 0;
    const discountAmount = (discountPercent / 100) * subTotal;
    const total = subTotal - discountAmount;
    const taxAmount = (taxPercent / 100) * total;
    const paid = parseFloat($('#amountPaid').val()) || 0;
    const total_with_tax = total + taxAmount;
    const due = total_with_tax - paid;
   

    $('#subTotal').text(`$${subTotal.toFixed(2)}`);
    $('#discountValue').text(`$${discountAmount.toFixed(2)}`);
    $('#taxValue').text(`$${taxAmount.toFixed(2)}`);
    $('#taxValueInput').val(`${taxAmount.toFixed(2)}`);
    $('#total').text(`$${total_with_tax.toFixed(2)}`);
    $('#amountDue').text(`$${due.toFixed(2)}`); 
   
    $('#hiddenSubTotal').val(subTotal.toFixed(2));
}



    $(document).on('input', '.qty, .price, #amountPaid, #discountInput, #taxInput', calculate);


let itemIndex = 1;
    $('#addRow').on('click', function () {
        const row = `<tr>
             <td><input type="text" class="form-control product" name="items[${itemIndex}][product]" style="background-color:#FDF5F6; border-color:#D8405533;"></td>
        <td><input type="text" class="form-control description" name="items[${itemIndex}][description]" style="background-color:#FDF5F6; border-color:#D8405533;"></td>
        <td><input type="number" class="form-control qty" value="1" name="items[${itemIndex}][qty]" style="background-color:#FDF5F6; border-color:#D8405533;"></td>
        <td><input type="number" class="form-control price" value="" name="items[${itemIndex}][price]" style="background-color:#FDF5F6; border-color:#D8405533;"></td>
        <td><input type="text" class="form-control amount" value="0" name="items[${itemIndex}][amount]" readonly style="background-color:#FDF5F6; border-color:#D8405533;"></td>
        <td><button type="button" class="btn btn-sm btn-danger removeRow"><i class="fas fa-trash"></i></button></td>
        </tr>`;
        $('#invoice-table tbody').append(row);
        itemIndex++;
    });

    $(document).on('click', '.removeRow', function () {
        $(this).closest('tr').remove();
        calculate();
    });

    $(document).ready(function () {
        calculate(); // initial calculation
    });
</script>
<script>
       
    function recalculateTotals() {
        let subTotal = 0;
        document.querySelectorAll('.amountField').forEach(item => {
            subTotal += parseFloat(item.value || 0);
        });

        let discount = parseFloat(document.getElementById('discountInput').value || 0);
        let amountPaid = parseFloat(document.getElementById('amountPaid').value || 0);
        let taxInput = parseFloat(document.getElementById('taxInput').value || 0);
        // console.log(taxInput);
        let total = subTotal - discount;
        let amountDue = total - amountPaid;

        document.getElementById('subTotal').innerText = `$${subTotal.toFixed(2)}`;
        document.getElementById('total').innerText = `$${total.toFixed(2)}`;
        document.getElementById('amountDue').innerText = `$${amountDue.toFixed(2)}`;
    }

    // Call on input changes
    document.getElementById('discountInput').addEventListener('input', recalculateTotals);
     document.getElementById('taxInput').addEventListener('input', recalculateTotals);
    document.getElementById('amountPaid').addEventListener('input', recalculateTotals);

  
</script>

<script src="https://cdn.jsdelivr.net/npm/jquery-validation@1.19.5/dist/jquery.validate.min.js"></script>
<script>
$(document).ready(function () {
    $('#customerForm').validate({
        ignore: [],
        rules: {
            case_id: { required: true },
            date: { required: true },
            payment_type: { required: true }
        },
        messages: {
            case_id: { required: "Please select case id" },
            date: { required: "Please select date" },
            payment_type: { required: "Please select payment type" }
        },
        errorElement: 'span',
        errorClass: 'text-danger-error',
        highlight: function (element) {
            $(element).addClass('is-invalid');
        },
        unhighlight: function (element) {
            $(element).removeClass('is-invalid');
        },
        submitHandler: function (form) {
            let isValid = true;

            // Remove all previous custom errors
            $('.error-msg').remove();
            $('.product, .description, .qty, .price').removeClass('is-invalid');

            $('#invoice-table tbody tr').each(function () {
                let productInput = $(this).find('.product');
                let descInput = $(this).find('.description');
                let qtyInput = $(this).find('.qty');
                let priceInput = $(this).find('.price');

                // Product
                if (productInput.val().trim() === '') {
                    productInput.addClass('is-invalid');
                    if (productInput.next('.error-msg').length === 0) {
                        productInput.after('<span class="text-danger-error error-msg">Product Field required</span>');
                    }
                    isValid = false;
                }

                // Description
                if (descInput.val().trim() === '') {
                    descInput.addClass('is-invalid');
                    if (descInput.next('.error-msg').length === 0) {
                        descInput.after('<span class="text-danger-error error-msg">Description Field required</span>');
                    }
                    isValid = false;
                }

                // Qty
                if (qtyInput.val().trim() === '' || parseFloat(qtyInput.val()) <= 0) {
                    qtyInput.addClass('is-invalid');
                    if (qtyInput.next('.error-msg').length === 0) {
                        qtyInput.after('<span class="text-danger-error error-msg">Valid quantity required</span>');
                    }
                    isValid = false;
                }

                // Price
                if (priceInput.val().trim() === '' || parseFloat(priceInput.val()) < 0) {
                    priceInput.addClass('is-invalid');
                    if (priceInput.next('.error-msg').length === 0) {
                        priceInput.after('<span class="text-danger-error error-msg">Price required</span>');
                    }
                    isValid = false;
                }
            });

            if (!isValid) {
                // alert("Please fill all required fields in product table");
                return false;
            }

            $('#submitBtn').html('Processing...').attr('disabled', true);
            form.submit();
        }
    });
});


document.addEventListener('DOMContentLoaded', function () {
    // Get the DOM elements
    const total = document.getElementById('total');
    const amountPaid = document.getElementById('amountPaid');
    const remainingInput = document.getElementById('remaining');
 
    function calculateRemaining() {
        // Use jQuery to get the current values
       
        // const totalValue =  total.textContent
        const totalValue = parseFloat(total.textContent.replace('$', '').trim()); // 0
        const paidValue = parseFloat($('#amountPaid').val()) || 0;
   
        if (paidValue > totalValue) {
            alert("Amount Paid cannot be greater than total amount.");
            $('#amountPaid').val('');
            $('#remaining').val('');
        } else {
            const remaining = totalValue - paidValue;
            $('#remaining').val(remaining.toFixed(2));
        }
    }

    // Add keyup listeners to DOM elements
    total.addEventListener('keyup', calculateRemaining);
    amountPaid.addEventListener('keyup', calculateRemaining);
});



</script>

<style>
.text-danger-error {
    color: red;
    font-size: 13px;
}
</style>




